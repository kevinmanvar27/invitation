/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Primary color palette - using specified colors
        primary: {
          light: '#7fb7f2', // light blue
          DEFAULT: '#7fb7f2', // light blue
          dark: '#7fb7f2', // light blue
        },
        // Secondary color palette - using specified colors
        secondary: {
          light: '#9bd698', // light green
          DEFAULT: '#9bd698', // light green
          dark: '#9bd698', // light green
        },
        // Accent color - using specified colors
        accent: {
          light: '#fbe17e', // light yellow
          DEFAULT: '#fbe17e', // light yellow
          dark: '#fbe17e', // light yellow
        },
        // Surface colors - using specified colors
        surface: {
          light: '#ffffff', // white
          DEFAULT: '#ffffff', // white
          dark: '#7fb7f2', // light blue
        },
        // Background colors - using specified colors
        background: {
          light: '#ffffff', // white
          DEFAULT: '#ffffff', // white
          dark: '#7fb7f2', // light blue
        },
        // Text colors - using specified colors
        text: {
          light: '#7fb7f2', // light blue
          DEFAULT: '#7fb7f2', // light blue
          dark: '#ffffff', // white
          secondary: {
            light: '#9bd698', // light green
            DEFAULT: '#9bd698', // light green
            dark: '#fbe17e', // light yellow
          }
        },
        // Border colors - using specified colors
        border: {
          light: '#fbe17e', // light yellow
          DEFAULT: '#fbe17e', // light yellow
          dark: '#9bd698', // light green
        },
        // Warning/Alert colors - using specified colors
        warning: {
          light: '#fbe17e', // light yellow
          DEFAULT: '#fbe17e', // light yellow
          dark: '#fbe17e', // light yellow
        },
        // Success colors - using specified colors
        success: {
          light: '#9bd698', // light green
          DEFAULT: '#9bd698', // light green
          dark: '#9bd698', // light green
        },
        // Error colors - using specified colors
        error: {
          light: '#7fb7f2', // light blue
          DEFAULT: '#7fb7f2', // light blue
          dark: '#7fb7f2', // light blue
        }
      },
    },
  },
  plugins: [],
  // Purge unused styles in production
  purge: {
    enabled: true,
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
  },
}