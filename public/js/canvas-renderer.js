/**
 * Canvas Renderer - Shared rendering logic for templates
 * This ensures templates display consistently across all pages
 * (admin edit, user editor, preview, display, etc.)
 */

class CanvasRenderer {
    constructor(canvasElement, canvasData, options = {}) {
        this.canvas = canvasElement;
        this.canvasData = canvasData;
        this.options = {
            interactive: options.interactive !== undefined ? options.interactive : true,
            editable: options.editable !== undefined ? options.editable : false,
            scale: options.scale || 1,
            ...options
        };
        
        this.elements = [];
        this.currentPageIndex = 0;
        this.pages = [];
        
        this.init();
    }
    
    init() {
        if (!this.canvasData) {
            console.warn('No canvas data provided');
            return;
        }
        
        // Set canvas dimensions
        if (this.canvasData.width && this.canvasData.height) {
            this.canvas.style.width = this.canvasData.width + 'px';
            this.canvas.style.height = this.canvasData.height + 'px';
        }
        
        // Load pages structure
        if (this.canvasData.pages && Array.isArray(this.canvasData.pages)) {
            this.pages = this.canvasData.pages;
            this.elements = this.pages[0]?.elements || [];
        } else if (this.canvasData.elements && Array.isArray(this.canvasData.elements)) {
            // Legacy format - single page
            this.elements = this.canvasData.elements;
            this.pages = [{
                id: 'page_1',
                name: 'Page 1',
                elements: this.elements,
                background: this.canvasData.background || {}
            }];
        }
        
        // Apply background
        this.applyBackground();
        
        // Render all elements
        this.renderAllElements();
    }
    
    applyBackground() {
        const background = this.pages[this.currentPageIndex]?.background || this.canvasData.background || {};
        
        // Clear existing background overlay
        const existingOverlay = this.canvas.querySelector('.canvas-background-overlay');
        if (existingOverlay) existingOverlay.remove();
        
        if (background.type === 'image' && background.image) {
            // Create background overlay
            const overlay = document.createElement('div');
            overlay.className = 'canvas-background-overlay';
            overlay.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                pointer-events: none;
                z-index: 0;
                background-color: ${background.color || '#ffffff'};
                background-image: url('${background.image}');
                background-size: ${background.size === 'tile' ? 'auto' : (background.size === 'stretch' ? '100% 100%' : background.size || 'cover')};
                background-repeat: ${background.size === 'tile' ? 'repeat' : 'no-repeat'};
                background-position: center;
                opacity: ${background.opacity !== undefined ? background.opacity : 1};
            `;
            this.canvas.insertBefore(overlay, this.canvas.firstChild);
            this.canvas.style.backgroundColor = background.color || '#ffffff';
        } else {
            this.canvas.style.backgroundColor = background.color || '#ffffff';
            this.canvas.style.backgroundImage = 'none';
        }
    }
    
    renderAllElements() {
        // Clear existing elements
        this.canvas.querySelectorAll('.canvas-element').forEach(el => el.remove());
        
        // Render each element
        this.elements.forEach(element => {
            this.renderElement(element);
        });
    }
    
    renderElement(element) {
        const div = document.createElement('div');
        div.id = element.id;
        div.className = 'canvas-element ' + element.type + '-element';
        div.style.position = 'absolute';
        div.style.left = element.x + 'px';
        div.style.top = element.y + 'px';
        
        if (element.rotation) {
            div.style.transform = `rotate(${element.rotation}deg)`;
        }
        
        // Set z-index
        const index = this.elements.findIndex(el => el.id === element.id);
        div.style.zIndex = index + 1;
        
        // Render based on type
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
        
        this.canvas.appendChild(div);
    }
    
    renderTextElement(div, element) {
        div.textContent = element.content || element.text || '';
        if (element.width && element.width !== 'auto') {
            div.style.width = element.width + 'px';
        }
        
        // Apply text styles
        const styles = element.styles || {};
        Object.assign(div.style, {
            fontFamily: styles.fontFamily || element.fontFamily || 'Arial',
            fontSize: styles.fontSize || (element.fontSize ? element.fontSize + 'px' : '16px'),
            fontWeight: styles.fontWeight || element.fontWeight || 'normal',
            fontStyle: styles.fontStyle || element.fontStyle || 'normal',
            textAlign: styles.textAlign || element.textAlign || 'left',
            color: styles.color || element.fill || element.color || '#000000',
            textDecoration: styles.textDecoration || 'none',
            lineHeight: styles.lineHeight || '1.5'
        });
    }
    
    renderImageElement(div, element) {
        div.style.width = element.width + 'px';
        div.style.height = element.height + 'px';
        div.style.overflow = 'hidden';
        
        const img = document.createElement('img');
        img.src = element.src;
        img.draggable = false;
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        
        div.appendChild(img);
    }
    
    renderShapeElement(div, element) {
        div.style.width = element.width + 'px';
        div.style.height = element.height + 'px';
        
        const svgNS = "http://www.w3.org/2000/svg";
        const svg = document.createElementNS(svgNS, "svg");
        svg.setAttribute("viewBox", "0 0 100 100");
        svg.setAttribute("preserveAspectRatio", "none");
        svg.style.width = "100%";
        svg.style.height = "100%";
        
        const styles = element.styles || {};
        const fill = styles.backgroundColor || element.fill || '#ef4444';
        const stroke = styles.borderColor || element.stroke || 'transparent';
        const strokeWidth = parseInt(styles.borderWidth || element.strokeWidth) || 0;
        
        let shape;
        const shapeType = element.shapeType || element.shape;
        
        switch(shapeType) {
            case 'rectangle':
            case 'rounded-rect':
                shape = document.createElementNS(svgNS, "rect");
                shape.setAttribute("x", "2");
                shape.setAttribute("y", "2");
                shape.setAttribute("width", "96");
                shape.setAttribute("height", "96");
                if (shapeType === 'rounded-rect') {
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
    
    renderLineElement(div, element) {
        div.style.width = element.width + 'px';
        div.style.height = element.height + 'px';
        const styles = element.styles || {};
        div.style.backgroundColor = styles.backgroundColor || element.color || '#ef4444';
    }
    
    renderIconElement(div, element) {
        div.style.width = element.width + 'px';
        div.style.height = element.height + 'px';
        div.style.display = 'flex';
        div.style.alignItems = 'center';
        div.style.justifyContent = 'center';
        
        const icon = document.createElement('i');
        icon.className = 'fas ' + element.iconClass;
        icon.style.fontSize = Math.min(element.width, element.height) * 0.8 + 'px';
        const styles = element.styles || {};
        icon.style.color = styles.color || element.color || '#ef4444';
        div.appendChild(icon);
    }
    
    renderFrameElement(div, element) {
        div.style.width = element.width + 'px';
        div.style.height = element.height + 'px';
        const styles = element.styles || {};
        div.style.border = `${styles.borderWidth || '4px'} solid ${styles.borderColor || '#000000'}`;
        
        const frameType = element.frameType || 'square';
        if (frameType === 'circle') {
            div.style.borderRadius = '50%';
        } else if (frameType === 'rounded') {
            div.style.borderRadius = '20px';
        }
        
        if (element.imageSrc || element.src) {
            const img = document.createElement('img');
            img.src = element.imageSrc || element.src;
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            if (frameType === 'circle') {
                img.style.borderRadius = '50%';
            }
            div.appendChild(img);
        }
    }
    
    switchToPage(index) {
        if (index < 0 || index >= this.pages.length) return;
        
        this.currentPageIndex = index;
        this.elements = this.pages[index].elements || [];
        
        this.applyBackground();
        this.renderAllElements();
    }
    
    destroy() {
        this.canvas.innerHTML = '';
    }
}

// Export for use in modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = CanvasRenderer;
}
