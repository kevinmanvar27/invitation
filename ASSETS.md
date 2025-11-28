# Asset Building and Optimization

This document explains how to build and optimize assets for the wedding invitation application.

## Asset Building Process

The application uses Vite with Tailwind CSS for asset compilation. All assets are built locally and then deployed to production.

### Scripts

1. **[build.sh](file:///Users/RekTech/Downloads/invitation/build.sh)** - Builds assets for production
2. **[optimize.sh](file:///Users/RekTech/Downloads/invitation/optimize.sh)** - Shows asset sizes and optimization info
3. **[deploy.sh](file:///Users/RekTech/Downloads/invitation/deploy.sh)** - Runs the complete deployment process

### Building Assets

To build assets for production, run:

```bash
./build.sh
```

This will:
- Install dependencies if needed
- Compile CSS and JavaScript using Vite
- Generate optimized assets in the `public/build/` directory

### Deployment

To run the complete deployment process:

```bash
./deploy.sh
```

This will:
- Build assets
- Optimize assets
- Show asset information
- Display the manifest file

## Asset Optimization

The application is optimized for fast loading times:

- **CSS**: ~9KB gzipped
- **JavaScript**: ~37KB gzipped
- **Total**: ~56KB for all assets

### Optimization Techniques

1. **Tree Shaking**: Unused CSS is removed during the build process
2. **Minification**: CSS and JavaScript are minified
3. **Gzip Compression**: Assets are compressed for faster delivery
4. **Caching**: Assets are cached with unique filenames

## Production Deployment

For production deployment:

1. Run the build process locally
2. Deploy the `public/build/` directory to production
3. Ensure the Laravel application can serve the compiled assets

The production server does not require Node.js or NPM, as all assets are pre-compiled.