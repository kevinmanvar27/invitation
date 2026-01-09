/**
 * Design Preview Renderer
 * Renders design previews using the same HTML/CSS approach as the admin editor
 * This ensures consistent rendering across all pages (gallery, single view, editor)
 */

class DesignPreviewRenderer {
    constructor(container, canvasData, options = {}) {
        this.container = container;
        this.canvasData = canvasData;
        this.options = {
            interactive: false, // Whether elements should be interactive
            scale: options.scale || 1, // Scale factor for rendering
            maxWidth: options.maxWidth || null,
            maxHeight: options.maxHeight || null,
            ...options
        };
        
        this.canvasWidth = canvasData.width || 800;
        this.canvasHeight = canvasData.height || 600;
        this.elements = [];
        this.background = {
            type: 'color',
            color: '#ffffff',
            image: null,
            opacity: 1,
            size: 'cover'
        };
    }

    /**
     * Main render method
     */
    async render() {
        try {
            // Load design data
            this.loadDesignData();
            
            // Calculate display dimensions
            const dimensions = this.calculateDimensions();
            
            // Create canvas container
            this.createCanvasContainer(dimensions);
            
            // Apply background
            this.applyBackground();
            
            // Render all elements
            this.renderAllElements();
            
            return true;
        } catch (error) {
            console.error('Error rendering design:', error);
            return false;
        }
    }

    /**
     * Load design data from canvas_data
     */
    loadDesignData() {
        // Load background
        if (this.canvasData.background) {
            this.background = { ...this.background, ...this.canvasData.background };
        }
        
        // Load elements from pages or legacy format
        if (this.canvasData.pages && Array.isArray(this.canvasData.pages) && this.canvasData.pages.length > 0) {
            // Multi-page format - render first page
            const firstPage = this.canvasData.pages[0];
            this.elements = firstPage.elements || [];
            if (firstPage.background) {
                this.background = { ...this.background, ...firstPage.background };
            }
        } else if (this.canvasData.elements && Array.isArray(this.canvasData.elements)) {
            // Legacy single-page format
            this.elements = this.canvasData.elements;
        }
    }

    /**
     * Calculate display dimensions maintaining aspect ratio
     */
    calculateDimensions() {
        const aspectRatio = this.canvasWidth / this.canvasHeight;
        let displayWidth = this.canvasWidth;
        let displayHeight = this.canvasHeight;
        
        // Apply max width constraint
        if (this.options.maxWidth && displayWidth > this.options.maxWidth) {
            displayWidth = this.options.maxWidth;
            displayHeight = displayWidth / aspectRatio;
        }
        
        // Apply max height constraint
        if (this.options.maxHeight && displayHeight > this.options.maxHeight) {
            displayHeight = this.options.maxHeight;
            displayWidth = displayHeight * aspectRatio;
        }
        
        // Calculate scale factor
        const scale = displayWidth / this.canvasWidth;
        
        return {
            width: displayWidth,
            height: displayHeight,
            scale: scale
        };
    }

    /**
     * Create canvas container div
     */
    createCanvasContainer(dimensions) {
        // Clear container
        this.container.innerHTML = '';
        
        // Create canvas div
        this.canvasDiv = document.createElement('div');
        this.canvasDiv.className = 'design-preview-canvas';
        this.canvasDiv.style.cssText = `
            position: relative;
            width: ${dimensions.width}px;
            height: ${dimensions.height}px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 0 auto;
        `;
        
        // Store scale for element rendering
        this.scale = dimensions.scale;
        
        this.container.appendChild(this.canvasDiv);
    }

    /**
     * Apply background to canvas
     */
    applyBackground() {
        if (this.background.type === 'image' && this.background.image) {
            // Create background overlay for image
            const bgOverlay = document.createElement('div');
            bgOverlay.className = 'canvas-background-overlay';
            bgOverlay.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                pointer-events: none;
                z-index: 0;
                background-color: ${this.background.color || '#ffffff'};
                background-image: url('${this.background.image}');
                background-size: ${this.background.size === 'tile' ? 'auto' : (this.background.size === 'stretch' ? '100% 100%' : this.background.size)};
                background-repeat: ${this.background.size === 'tile' ? 'repeat' : 'no-repeat'};
                background-position: center;
                opacity: ${this.background.opacity};
            `;
            this.canvasDiv.insertBefore(bgOverlay, this.canvasDiv.firstChild);
            this.canvasDiv.style.backgroundColor = this.background.color || '#ffffff';
        } else {
            this.canvasDiv.style.backgroundColor = this.background.color || '#ffffff';
        }
    }

    /**
     * Render all elements
     */
    renderAllElements() {
        this.elements.forEach((element, index) => {
            this.renderElement(element, index);
        });
    }

    /**
     * Render a single element
     */
    renderElement(element, index) {
        const div = document.createElement('div');
        div.className = 'canvas-element ' + element.type + '-element';
        div.style.position = 'absolute';
        div.style.left = (element.x * this.scale) + 'px';
        div.style.top = (element.y * this.scale) + 'px';
        div.style.zIndex = index + 1;
        
        if (element.rotation) {
            div.style.transform = `rotate(${element.rotation}deg)`;
        }
        
        // Render based on element type
        switch(element.type) {
            case 'text':
                this.renderTextElement(div, element);
                break;
            case 'image':
                this.renderImageElement(div, element);
                break;
            case 'shape':
                this.renderShapeElement(div, element);
                break;
            case 'line':
                this.renderLineElement(div, element);
                break;
            case 'icon':
                this.renderIconElement(div, element);
                break;
            case 'frame':
                this.renderFrameElement(div, element);
                break;
        }
        
        this.canvasDiv.appendChild(div);
    }

    /**
     * Render text element
     */
    renderTextElement(div, element) {
        div.textContent = element.content || 'Text';
        
        // Apply width if specified
        if (element.width && element.width !== 'auto') {
            div.style.width = (element.width * this.scale) + 'px';
        }
        
        // Apply styles
        if (element.styles) {
            Object.keys(element.styles).forEach(key => {
                // Scale font size
                if (key === 'fontSize') {
                    const fontSize = parseInt(element.styles[key]);
                    div.style.fontSize = (fontSize * this.scale) + 'px';
                }
                // Scale line height
                else if (key === 'lineHeight') {
                    div.style.lineHeight = element.styles[key];
                }
                // Apply other styles directly
                else {
                    div.style[key] = element.styles[key];
                }
            });
        }
        
        // Prevent text selection in preview mode
        if (!this.options.interactive) {
            div.style.userSelect = 'none';
            div.style.pointerEvents = 'none';
        }
    }

    /**
     * Render image element
     */
    renderImageElement(div, element) {
        div.style.width = (element.width * this.scale) + 'px';
        div.style.height = (element.height * this.scale) + 'px';
        div.style.overflow = 'hidden';
        
        const img = document.createElement('img');
        img.src = element.src;
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        img.style.display = 'block';
        img.draggable = false;
        
        // Apply opacity if specified
        if (element.styles && element.styles.opacity) {
            img.style.opacity = element.styles.opacity;
        }
        
        div.appendChild(img);
    }

    /**
     * Render shape element
     */
    renderShapeElement(div, element) {
        div.style.width = (element.width * this.scale) + 'px';
        div.style.height = (element.height * this.scale) + 'px';
        
        const svgNS = "http://www.w3.org/2000/svg";
        const svg = document.createElementNS(svgNS, "svg");
        svg.setAttribute("viewBox", "0 0 100 100");
        svg.setAttribute("preserveAspectRatio", "none");
        svg.style.width = "100%";
        svg.style.height = "100%";
        svg.style.display = "block";
        
        let shape;
        const fill = (element.styles && element.styles.backgroundColor) || '#ef4444';
        const stroke = (element.styles && element.styles.borderColor) || 'transparent';
        const strokeWidth = (element.styles && parseInt(element.styles.borderWidth)) || 0;
        
        switch(element.shapeType) {
            case 'rectangle':
            case 'rounded-rect':
                shape = document.createElementNS(svgNS, "rect");
                shape.setAttribute("x", "2");
                shape.setAttribute("y", "2");
                shape.setAttribute("width", "96");
                shape.setAttribute("height", "96");
                if (element.shapeType === 'rounded-rect') {
                    shape.setAttribute("rx", "15");
                }
                break;
            case 'circle':
                shape = document.createElementNS(svgNS, "circle");
                shape.setAttribute("cx", "50");
                shape.setAttribute("cy", "50");
                shape.setAttribute("r", "48");
                break;
            case 'oval':
                shape = document.createElementNS(svgNS, "ellipse");
                shape.setAttribute("cx", "50");
                shape.setAttribute("cy", "50");
                shape.setAttribute("rx", "48");
                shape.setAttribute("ry", "30");
                break;
            case 'triangle':
                shape = document.createElementNS(svgNS, "polygon");
                shape.setAttribute("points", "50,5 95,95 5,95");
                break;
            case 'star':
                shape = document.createElementNS(svgNS, "polygon");
                shape.setAttribute("points", "50,5 61,40 98,40 68,62 79,97 50,75 21,97 32,62 2,40 39,40");
                break;
            case 'heart':
                shape = document.createElementNS(svgNS, "path");
                shape.setAttribute("d", "M50,88 C20,60 5,40 5,25 C5,10 20,5 35,15 C42,20 47,25 50,30 C53,25 58,20 65,15 C80,5 95,10 95,25 C95,40 80,60 50,88 Z");
                break;
            case 'hexagon':
                shape = document.createElementNS(svgNS, "polygon");
                shape.setAttribute("points", "50,5 93,25 93,75 50,95 7,75 7,25");
                break;
            case 'diamond':
                shape = document.createElementNS(svgNS, "polygon");
                shape.setAttribute("points", "50,5 95,50 50,95 5,50");
                break;
        }
        
        if (shape) {
            shape.setAttribute("fill", fill);
            shape.setAttribute("stroke", stroke);
            shape.setAttribute("stroke-width", strokeWidth);
            svg.appendChild(shape);
        }
        
        div.appendChild(svg);
    }

    /**
     * Render line element
     */
    renderLineElement(div, element) {
        const width = (element.width * this.scale);
        const height = (element.height * this.scale) || 2;
        
        div.style.width = width + 'px';
        div.style.height = height + 'px';
        div.style.backgroundColor = (element.styles && element.styles.backgroundColor) || '#000000';
        div.style.opacity = (element.styles && element.styles.opacity) || 1;
    }

    /**
     * Render icon element
     */
    renderIconElement(div, element) {
        div.style.width = (element.width * this.scale) + 'px';
        div.style.height = (element.height * this.scale) + 'px';
        div.style.display = 'flex';
        div.style.alignItems = 'center';
        div.style.justifyContent = 'center';
        
        const icon = document.createElement('i');
        icon.className = element.iconClass || 'fas fa-star';
        icon.style.fontSize = ((element.width * 0.8) * this.scale) + 'px';
        icon.style.color = (element.styles && element.styles.color) || '#000000';
        
        div.appendChild(icon);
    }

    /**
     * Render frame element
     */
    renderFrameElement(div, element) {
        div.style.width = (element.width * this.scale) + 'px';
        div.style.height = (element.height * this.scale) + 'px';
        div.style.border = '2px solid ' + ((element.styles && element.styles.borderColor) || '#000000');
        div.style.borderRadius = (element.styles && element.styles.borderRadius) || '0';
        div.style.backgroundColor = 'transparent';
    }
}

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = DesignPreviewRenderer;
}
