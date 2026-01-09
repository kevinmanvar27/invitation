/**
 * Canvas 2D Renderer - Renders templates to HTML5 Canvas using 2D context
 * Used for static previews and displays (show pages, thumbnails, etc.)
 */

class Canvas2DRenderer {
    constructor(canvasElement, canvasData, options = {}) {
        this.canvas = canvasElement;
        this.ctx = canvasElement.getContext('2d');
        this.canvasData = canvasData;
        this.options = {
            maxWidth: options.maxWidth || null,
            maxHeight: options.maxHeight || null,
            ...options
        };
        
        this.elements = [];
        this.currentPageIndex = 0;
        this.pages = [];
        this.imagesToLoad = 0;
        this.imagesLoaded = 0;
        
        // Polyfill for roundRect if not available
        if (!this.ctx.roundRect) {
            this.ctx.roundRect = function(x, y, width, height, radius) {
                this.beginPath();
                this.moveTo(x + radius, y);
                this.lineTo(x + width - radius, y);
                this.arcTo(x + width, y, x + width, y + radius, radius);
                this.lineTo(x + width, y + height - radius);
                this.arcTo(x + width, y + height, x + width - radius, y + height, radius);
                this.lineTo(x + radius, y + height);
                this.arcTo(x, y + height, x, y + height - radius, radius);
                this.lineTo(x, y + radius);
                this.arcTo(x, y, x + radius, y, radius);
                this.closePath();
            };
        }
    }
    
    init() {
        if (!this.canvasData) {
            console.warn('❌ No canvas data provided');
            return;
        }
        
        console.log('🎨 Canvas2DRenderer: Initializing...');
        console.log('📊 Canvas data structure:', {
            hasPages: !!(this.canvasData.pages),
            hasElements: !!(this.canvasData.elements),
            width: this.canvasData.width,
            height: this.canvasData.height
        });
        
        // Set canvas dimensions
        this.setupDimensions();
        
        // Load pages structure
        this.loadPages();
        
        // Load fonts and then render
        this.loadFonts().then(() => {
            console.log('✓ Fonts loaded, rendering...');
            this.render();
        }).catch((error) => {
            console.warn('⚠️ Some fonts failed to load, rendering anyway:', error);
            this.render();
        });
    }
    
    async loadFonts() {
        // Extract unique font families from all text elements
        const fontFamilies = new Set();
        
        this.elements.forEach(element => {
            if (element.type === 'text') {
                const styles = element.styles || {};
                const fontFamily = styles.fontFamily || element.fontFamily;
                if (fontFamily && fontFamily !== 'Arial' && fontFamily !== 'sans-serif') {
                    fontFamilies.add(fontFamily);
                }
            }
        });
        
        if (fontFamilies.size === 0) {
            console.log('✓ No custom fonts to load');
            return Promise.resolve();
        }
        
        console.log('📝 Loading fonts:', Array.from(fontFamilies));
        
        // Wait for document.fonts.ready first
        await document.fonts.ready;
        
        // Then explicitly load each font
        const fontPromises = Array.from(fontFamilies).map(async (fontFamily) => {
            try {
                await document.fonts.load(`16px "${fontFamily}"`);
                console.log(`  ✓ Loaded: ${fontFamily}`);
            } catch (err) {
                console.warn(`  ⚠️ Failed to load font: ${fontFamily}`, err);
            }
        });
        
        await Promise.all(fontPromises);
        console.log('✓ All fonts loaded successfully');
    }
    
    setupDimensions() {
        const canvasWidth = this.canvasData.width || 800;
        const canvasHeight = this.canvasData.height || 600;
        
        // Set actual canvas size (internal resolution)
        this.canvas.width = canvasWidth;
        this.canvas.height = canvasHeight;
        
        // Calculate display size if max dimensions provided
        if (this.options.maxWidth || this.options.maxHeight) {
            const aspectRatio = canvasWidth / canvasHeight;
            let displayWidth = canvasWidth;
            let displayHeight = canvasHeight;
            
            // Scale down to fit maxWidth if needed
            if (this.options.maxWidth && displayWidth > this.options.maxWidth) {
                displayWidth = this.options.maxWidth;
                displayHeight = displayWidth / aspectRatio;
            }
            
            // Scale down to fit maxHeight if needed
            if (this.options.maxHeight && displayHeight > this.options.maxHeight) {
                displayHeight = this.options.maxHeight;
                displayWidth = displayHeight * aspectRatio;
            }
            
            this.canvas.style.width = Math.floor(displayWidth) + 'px';
            this.canvas.style.height = Math.floor(displayHeight) + 'px';
            
            console.log('✓ Canvas dimensions set:', {
                internal: `${canvasWidth}x${canvasHeight}`,
                display: `${Math.floor(displayWidth)}x${Math.floor(displayHeight)}`,
                aspectRatio: aspectRatio.toFixed(2)
            });
        } else {
            console.log('✓ Canvas dimensions set:', canvasWidth, 'x', canvasHeight);
        }
    }
    
    loadPages() {
        if (this.canvasData.pages && Array.isArray(this.canvasData.pages) && this.canvasData.pages.length > 0) {
            // Pages-based structure
            console.log('📄 Using pages-based structure');
            this.pages = this.canvasData.pages;
            this.elements = this.pages[0]?.elements || [];
            console.log('📦 First page elements:', this.elements);
            
            // Log details of each element
            this.elements.forEach((el, idx) => {
                console.log(`  Element ${idx}:`, el.type, el.id);
                if (el.type === 'text') {
                    console.log(`    → Text: "${(el.text || el.content || '').substring(0, 30)}"`);
                    console.log(`    → Styles:`, el.styles);
                    console.log(`    → Font:`, el.fontFamily || el.styles?.fontFamily);
                    console.log(`    → Size:`, el.fontSize || el.styles?.fontSize);
                }
            });
        } else if (this.canvasData.elements && Array.isArray(this.canvasData.elements)) {
            // Legacy format - single page
            console.log('📄 Using legacy flat structure');
            this.elements = this.canvasData.elements;
            this.pages = [{
                id: 'page_1',
                name: 'Page 1',
                elements: this.elements,
                background: this.canvasData.background || {}
            }];
        } else {
            console.error('❌ No valid canvas data structure found');
            return;
        }
        
        console.log('📦 Total elements to render:', this.elements.length);
    }
    
    render() {
        // Reset image loading counters
        this.imagesToLoad = 0;
        this.imagesLoaded = 0;
        
        // Clear canvas
        this.ctx.fillStyle = '#ffffff';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
        
        // Render background
        const background = this.pages[this.currentPageIndex]?.background || {};
        console.log('🎨 Background:', background);
        
        if (background.type === 'color' || (background.color && !background.image)) {
            this.renderColorBackground(background);
        } else if (background.type === 'image' && background.image) {
            this.renderImageBackground(background);
        } else {
            // No background, just render elements
            this.renderElements();
        }
    }
    
    renderColorBackground(background) {
        console.log('🎨 Rendering color background:', background.color);
        this.ctx.fillStyle = background.color || '#ffffff';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
        this.renderElements();
    }
    
    renderImageBackground(background) {
        console.log('🖼️ Loading background image:', background.image);
        console.log('  → Background opacity:', background.opacity);
        console.log('  → Background color:', background.color);
        this.imagesToLoad++;
        
        // If there's a background color, render it first
        if (background.color) {
            console.log('  → Rendering background color first:', background.color);
            this.ctx.fillStyle = background.color;
            this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
        }
        
        const bgImg = new Image();
        bgImg.crossOrigin = 'anonymous';
        
        bgImg.onload = () => {
            console.log('✓ Background image loaded');
            this.ctx.save();
            this.ctx.globalAlpha = background.opacity !== undefined ? background.opacity : 1;
            console.log('  → Applying image with opacity:', this.ctx.globalAlpha);
            
            // Render based on size setting
            if (background.size === 'cover' || !background.size) {
                const scale = Math.max(
                    this.canvas.width / bgImg.width,
                    this.canvas.height / bgImg.height
                );
                const x = (this.canvas.width / 2) - (bgImg.width / 2) * scale;
                const y = (this.canvas.height / 2) - (bgImg.height / 2) * scale;
                this.ctx.drawImage(bgImg, x, y, bgImg.width * scale, bgImg.height * scale);
            } else if (background.size === 'stretch') {
                this.ctx.drawImage(bgImg, 0, 0, this.canvas.width, this.canvas.height);
            } else if (background.size === 'tile') {
                const pattern = this.ctx.createPattern(bgImg, 'repeat');
                this.ctx.fillStyle = pattern;
                this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
            } else {
                // Default: contain
                const scale = Math.min(
                    this.canvas.width / bgImg.width,
                    this.canvas.height / bgImg.height
                );
                const x = (this.canvas.width / 2) - (bgImg.width / 2) * scale;
                const y = (this.canvas.height / 2) - (bgImg.height / 2) * scale;
                this.ctx.drawImage(bgImg, x, y, bgImg.width * scale, bgImg.height * scale);
            }
            
            this.ctx.restore();
            this.imagesLoaded++;
            this.checkAllImagesLoaded();
        };
        
        bgImg.onerror = (e) => {
            console.error('❌ Failed to load background image:', e);
            this.imagesLoaded++;
            this.checkAllImagesLoaded();
        };
        
        bgImg.src = background.image;
    }
    
    checkAllImagesLoaded() {
        if (this.imagesToLoad > 0 && this.imagesLoaded === this.imagesToLoad) {
            console.log('✓ All images loaded, rendering elements');
            this.renderElements();
        }
    }
    
    renderElements() {
        if (!this.elements || this.elements.length === 0) {
            console.log('⚠️ No elements to render');
            return;
        }
        
        console.log('🎨 Rendering', this.elements.length, 'elements');
        
        // Sort elements by z-index
        const sortedElements = [...this.elements].sort((a, b) => (a.zIndex || 0) - (b.zIndex || 0));
        
        sortedElements.forEach((element, index) => {
            console.log(`  → Element ${index + 1}/${this.elements.length}:`, element.type, element);
            this.renderElement(element);
        });
        
        console.log('✅ All elements rendered successfully');
    }
    
    renderElement(element) {
        this.ctx.save();
        
        // Apply transformations
        if (element.rotation) {
            const centerX = element.x + (element.width || 0) / 2;
            const centerY = element.y + (element.height || 0) / 2;
            this.ctx.translate(centerX, centerY);
            this.ctx.rotate((element.rotation * Math.PI) / 180);
            this.ctx.translate(-centerX, -centerY);
        }
        
        if (element.opacity !== undefined) {
            this.ctx.globalAlpha = element.opacity;
        }
        
        // Render based on type
        switch(element.type) {
            case 'text':
                this.renderTextElement(element);
                break;
            case 'image':
                this.renderImageElement(element);
                break;
            case 'shape':
                this.renderShapeElement(element);
                break;
            case 'line':
                this.renderLineElement(element);
                break;
            case 'icon':
                this.renderIconElement(element);
                break;
            case 'frame':
                this.renderFrameElement(element);
                break;
            default:
                console.warn('Unknown element type:', element.type);
        }
        
        this.ctx.restore();
    }
    
    renderTextElement(element) {
        // Handle both formats: direct properties and styles object
        const styles = element.styles || {};
        
        // Extract fontSize - handle both string ("48px") and number (48) formats
        let fontSize = styles.fontSize || element.fontSize || 24;
        if (typeof fontSize === 'string') {
            fontSize = parseInt(fontSize);
        }
        
        const fontWeight = styles.fontWeight || element.fontWeight || 'normal';
        const fontStyle = styles.fontStyle || element.fontStyle || 'normal';
        const fontFamily = styles.fontFamily || element.fontFamily || 'Arial';
        const textColor = styles.color || element.fill || element.color || '#000000';
        const textAlign = styles.textAlign || element.textAlign || 'left';
        
        // Handle text decoration (underline, line-through, etc.)
        const textDecoration = styles.textDecoration || element.textDecoration || 'none';
        
        console.log(`    → Text element properties:`, {
            fontSize: fontSize,
            fontFamily: fontFamily,
            fontWeight: fontWeight,
            textColor: textColor,
            content: element.text || element.content,
            styles: styles,
            element: element
        });
        
        this.ctx.font = `${fontStyle} ${fontWeight} ${fontSize}px "${fontFamily}", Arial, sans-serif`;
        this.ctx.fillStyle = textColor;
        this.ctx.textAlign = textAlign;
        this.ctx.textBaseline = 'top';
        
        // Handle both 'text' and 'content' properties
        const text = element.text || element.content || '';
        const lines = text.split('\n');
        const lineHeight = fontSize * 1.2;
        
        console.log(`    → Rendering text: "${text.substring(0, 50)}" | Font: ${fontSize}px ${fontFamily} | Color: ${textColor}`);
        
        lines.forEach((line, i) => {
            const y = element.y + (i * lineHeight);
            this.ctx.fillText(line, element.x, y);
            
            // Handle text decoration manually (canvas doesn't support CSS text-decoration)
            if (textDecoration === 'underline') {
                const textWidth = this.ctx.measureText(line).width;
                this.ctx.beginPath();
                this.ctx.strokeStyle = textColor;
                this.ctx.lineWidth = Math.max(1, fontSize / 16);
                this.ctx.moveTo(element.x, y + fontSize + 2);
                this.ctx.lineTo(element.x + textWidth, y + fontSize + 2);
                this.ctx.stroke();
            } else if (textDecoration === 'line-through') {
                const textWidth = this.ctx.measureText(line).width;
                this.ctx.beginPath();
                this.ctx.strokeStyle = textColor;
                this.ctx.lineWidth = Math.max(1, fontSize / 16);
                this.ctx.moveTo(element.x, y + fontSize / 2);
                this.ctx.lineTo(element.x + textWidth, y + fontSize / 2);
                this.ctx.stroke();
            }
        });
    }
    
    renderImageElement(element) {
        if (!element.src) {
            console.warn('Image element missing src:', element);
            return;
        }
        
        console.log(`    → Loading image: ${element.src.substring(0, 100)}`);
        this.imagesToLoad++;
        
        const img = new Image();
        img.crossOrigin = 'anonymous';
        
        img.onload = () => {
            console.log(`    ✓ Image loaded successfully`);
            this.ctx.save();
            
            // Apply rotation if needed
            if (element.rotation) {
                const centerX = element.x + element.width / 2;
                const centerY = element.y + element.height / 2;
                this.ctx.translate(centerX, centerY);
                this.ctx.rotate((element.rotation * Math.PI) / 180);
                this.ctx.translate(-centerX, -centerY);
            }
            
            if (element.opacity !== undefined) {
                this.ctx.globalAlpha = element.opacity;
            }
            
            this.ctx.drawImage(img, element.x, element.y, element.width, element.height);
            this.ctx.restore();
            this.imagesLoaded++;
        };
        
        img.onerror = (e) => {
            console.error('❌ Failed to load image:', element.src, e);
            // Draw a placeholder rectangle
            this.ctx.save();
            this.ctx.fillStyle = '#f0f0f0';
            this.ctx.fillRect(element.x, element.y, element.width, element.height);
            this.ctx.strokeStyle = '#ccc';
            this.ctx.lineWidth = 2;
            this.ctx.strokeRect(element.x, element.y, element.width, element.height);
            this.ctx.restore();
            this.imagesLoaded++;
        };
        
        img.src = element.src;
    }
    
    renderShapeElement(element) {
        const styles = element.styles || {};
        const fill = styles.backgroundColor || element.fill || element.color || '#ef4444';
        const stroke = styles.borderColor || element.strokeColor || element.stroke;
        const strokeWidth = parseInt(styles.borderWidth || element.strokeWidth) || 0;
        
        this.ctx.fillStyle = fill;
        
        if (stroke && strokeWidth > 0) {
            this.ctx.strokeStyle = stroke;
            this.ctx.lineWidth = strokeWidth;
        }
        
        const shapeType = element.shapeType || element.shape || 'rectangle';
        
        this.ctx.beginPath();
        
        switch(shapeType) {
            case 'rectangle':
            case 'rounded-rect':
                if (shapeType === 'rounded-rect') {
                    const radius = 10;
                    this.ctx.roundRect(element.x, element.y, element.width, element.height, radius);
                } else {
                    this.ctx.rect(element.x, element.y, element.width, element.height);
                }
                break;
                
            case 'circle':
                const radius = Math.min(element.width, element.height) / 2;
                this.ctx.arc(
                    element.x + element.width / 2,
                    element.y + element.height / 2,
                    radius,
                    0,
                    2 * Math.PI
                );
                break;
                
            case 'ellipse':
                this.ctx.ellipse(
                    element.x + element.width / 2,
                    element.y + element.height / 2,
                    element.width / 2,
                    element.height / 2,
                    0,
                    0,
                    2 * Math.PI
                );
                break;
                
            case 'triangle':
                this.ctx.moveTo(element.x + element.width / 2, element.y);
                this.ctx.lineTo(element.x + element.width, element.y + element.height);
                this.ctx.lineTo(element.x, element.y + element.height);
                this.ctx.closePath();
                break;
                
            case 'star':
                this.renderStar(element);
                return;
                
            case 'heart':
                this.renderHeart(element);
                return;
                
            case 'hexagon':
                this.renderPolygon(element, 6);
                return;
                
            case 'octagon':
                this.renderPolygon(element, 8);
                return;
                
            case 'pentagon':
                this.renderPolygon(element, 5);
                return;
        }
        
        this.ctx.fill();
        if (stroke && strokeWidth > 0) {
            this.ctx.stroke();
        }
    }
    
    renderStar(element) {
        const cx = element.x + element.width / 2;
        const cy = element.y + element.height / 2;
        const outerRadius = Math.min(element.width, element.height) / 2;
        const innerRadius = outerRadius / 2;
        const points = 5;
        
        this.ctx.beginPath();
        for (let i = 0; i < points * 2; i++) {
            const radius = i % 2 === 0 ? outerRadius : innerRadius;
            const angle = (i * Math.PI) / points - Math.PI / 2;
            const x = cx + radius * Math.cos(angle);
            const y = cy + radius * Math.sin(angle);
            
            if (i === 0) {
                this.ctx.moveTo(x, y);
            } else {
                this.ctx.lineTo(x, y);
            }
        }
        this.ctx.closePath();
        this.ctx.fill();
        
        const styles = element.styles || {};
        const stroke = styles.borderColor || element.strokeColor;
        const strokeWidth = parseInt(styles.borderWidth || element.strokeWidth) || 0;
        if (stroke && strokeWidth > 0) {
            this.ctx.stroke();
        }
    }
    
    renderHeart(element) {
        const x = element.x + element.width / 2;
        const y = element.y + element.height / 3;
        const width = element.width;
        const height = element.height;
        
        this.ctx.beginPath();
        this.ctx.moveTo(x, y + height / 4);
        this.ctx.bezierCurveTo(x, y, x - width / 2, y, x - width / 2, y + height / 4);
        this.ctx.bezierCurveTo(x - width / 2, y + height / 2, x, y + height * 3 / 4, x, y + height);
        this.ctx.bezierCurveTo(x, y + height * 3 / 4, x + width / 2, y + height / 2, x + width / 2, y + height / 4);
        this.ctx.bezierCurveTo(x + width / 2, y, x, y, x, y + height / 4);
        this.ctx.closePath();
        this.ctx.fill();
        
        const styles = element.styles || {};
        const stroke = styles.borderColor || element.strokeColor;
        const strokeWidth = parseInt(styles.borderWidth || element.strokeWidth) || 0;
        if (stroke && strokeWidth > 0) {
            this.ctx.stroke();
        }
    }
    
    renderPolygon(element, sides) {
        const cx = element.x + element.width / 2;
        const cy = element.y + element.height / 2;
        const radius = Math.min(element.width, element.height) / 2;
        
        this.ctx.beginPath();
        for (let i = 0; i < sides; i++) {
            const angle = (i * 2 * Math.PI) / sides - Math.PI / 2;
            const x = cx + radius * Math.cos(angle);
            const y = cy + radius * Math.sin(angle);
            
            if (i === 0) {
                this.ctx.moveTo(x, y);
            } else {
                this.ctx.lineTo(x, y);
            }
        }
        this.ctx.closePath();
        this.ctx.fill();
        
        const styles = element.styles || {};
        const stroke = styles.borderColor || element.strokeColor;
        const strokeWidth = parseInt(styles.borderWidth || element.strokeWidth) || 0;
        if (stroke && strokeWidth > 0) {
            this.ctx.stroke();
        }
    }
    
    renderLineElement(element) {
        const styles = element.styles || {};
        const stroke = styles.borderColor || element.stroke || element.color || '#000000';
        const strokeWidth = parseInt(styles.borderWidth || element.strokeWidth || element.width) || 2;
        const lineType = element.lineType || 'solid';
        
        this.ctx.strokeStyle = stroke;
        this.ctx.lineWidth = strokeWidth;
        
        // Set line dash for different line types
        switch(lineType) {
            case 'dashed':
                this.ctx.setLineDash([10, 5]);
                break;
            case 'dotted':
                this.ctx.setLineDash([2, 3]);
                break;
            default:
                this.ctx.setLineDash([]);
        }
        
        this.ctx.beginPath();
        
        const direction = element.direction || 'horizontal';
        if (direction === 'horizontal') {
            this.ctx.moveTo(element.x, element.y);
            this.ctx.lineTo(element.x + element.length, element.y);
        } else {
            this.ctx.moveTo(element.x, element.y);
            this.ctx.lineTo(element.x, element.y + element.length);
        }
        
        this.ctx.stroke();
        this.ctx.setLineDash([]);
    }
    
    renderIconElement(element) {
        // Icons are typically SVG or font-based, which don't render well in canvas
        // For now, we'll render a placeholder
        console.warn('Icon rendering in Canvas 2D not fully supported:', element);
        
        // Draw a simple placeholder
        this.ctx.fillStyle = element.color || '#000000';
        this.ctx.font = `${element.size || 24}px FontAwesome`;
        this.ctx.textAlign = 'center';
        this.ctx.textBaseline = 'middle';
        this.ctx.fillText('★', element.x + (element.width || 24) / 2, element.y + (element.height || 24) / 2);
    }
    
    renderFrameElement(element) {
        // Frames are decorative borders around images
        const styles = element.styles || {};
        const stroke = styles.borderColor || element.stroke || '#000000';
        const strokeWidth = parseInt(styles.borderWidth || element.strokeWidth) || 4;
        const frameType = element.frameType || 'rectangle';
        
        // If frame has an image source (imageSrc), render it
        if (element.imageSrc || element.src) {
            const imgSrc = element.imageSrc || element.src;
            console.log(`    → Loading frame image: ${imgSrc.substring(0, 100)}`);
            this.imagesToLoad++;
            
            const img = new Image();
            img.crossOrigin = 'anonymous';
            
            img.onload = () => {
                console.log(`    ✓ Frame image loaded successfully`);
                this.ctx.save();
                
                // Create clipping path based on frame type
                this.ctx.beginPath();
                if (frameType === 'circle') {
                    const centerX = element.x + element.width / 2;
                    const centerY = element.y + element.height / 2;
                    const radius = Math.min(element.width, element.height) / 2;
                    this.ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                } else if (frameType === 'rounded') {
                    const radius = 20;
                    this.ctx.roundRect(element.x, element.y, element.width, element.height, radius);
                } else {
                    this.ctx.rect(element.x, element.y, element.width, element.height);
                }
                this.ctx.clip();
                
                // Draw image within the clipping path
                this.ctx.drawImage(img, element.x, element.y, element.width, element.height);
                this.ctx.restore();
                
                // Draw frame border
                this.ctx.strokeStyle = stroke;
                this.ctx.lineWidth = strokeWidth;
                this.ctx.beginPath();
                if (frameType === 'circle') {
                    const centerX = element.x + element.width / 2;
                    const centerY = element.y + element.height / 2;
                    const radius = Math.min(element.width, element.height) / 2;
                    this.ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                } else if (frameType === 'rounded') {
                    const radius = 20;
                    this.ctx.roundRect(element.x, element.y, element.width, element.height, radius);
                } else {
                    this.ctx.rect(element.x, element.y, element.width, element.height);
                }
                this.ctx.stroke();
                
                this.imagesLoaded++;
            };
            
            img.onerror = (e) => {
                console.error('❌ Failed to load frame image:', imgSrc, e);
                // Draw frame border only
                this.ctx.strokeStyle = stroke;
                this.ctx.lineWidth = strokeWidth;
                this.ctx.strokeRect(element.x, element.y, element.width, element.height);
                this.imagesLoaded++;
            };
            
            img.src = imgSrc;
        } else {
            // No image, just draw the frame border
            this.ctx.strokeStyle = stroke;
            this.ctx.lineWidth = strokeWidth;
            this.ctx.beginPath();
            if (frameType === 'circle') {
                const centerX = element.x + element.width / 2;
                const centerY = element.y + element.height / 2;
                const radius = Math.min(element.width, element.height) / 2;
                this.ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
            } else if (frameType === 'rounded') {
                const radius = 20;
                this.ctx.roundRect(element.x, element.y, element.width, element.height, radius);
            } else {
                this.ctx.rect(element.x, element.y, element.width, element.height);
            }
            this.ctx.stroke();
        }
    }
    
    switchToPage(pageIndex) {
        if (pageIndex >= 0 && pageIndex < this.pages.length) {
            this.currentPageIndex = pageIndex;
            this.elements = this.pages[pageIndex].elements || [];
            this.render();
        }
    }
}

// Make it available globally
window.Canvas2DRenderer = Canvas2DRenderer;
