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
        // Primary color palette
        primary: {
          light: '#3b82f6', // blue-500
          DEFAULT: '#2563eb', // blue-600
          dark: '#1d4ed8', // blue-700
        },
        // Secondary color palette
        secondary: {
          light: '#8b5cf6', // violet-500
          DEFAULT: '#7c3aed', // violet-600
          dark: '#6d28d9', // violet-700
        },
        // Surface colors
        surface: {
          light: '#f9fafb', // gray-50
          DEFAULT: '#f3f4f6', // gray-100
          dark: '#1f2937', // gray-800
        },
        // Background colors
        background: {
          light: '#ffffff', // white
          DEFAULT: '#f9fafb', // gray-50
          dark: '#111827', // gray-900
        },
        // Text colors
        text: {
          light: '#1f2937', // gray-800
          DEFAULT: '#374151', // gray-700
          dark: '#f9fafb', // gray-50
          secondary: {
            light: '#6b7280', // gray-500
            DEFAULT: '#4b5563', // gray-600
            dark: '#9ca3af', // gray-400
          }
        },
        // Border colors
        border: {
          light: '#e5e7eb', // gray-200
          DEFAULT: '#d1d5db', // gray-300
          dark: '#374151', // gray-700
        },
        // Warning/Alert colors
        warning: {
          light: '#fbbf24', // amber-400
          DEFAULT: '#f59e0b', // amber-500
          dark: '#d97706', // amber-600
        },
        // Success colors
        success: {
          light: '#34d399', // emerald-400
          DEFAULT: '#10b981', // emerald-500
          dark: '#059669', // emerald-600
        },
        // Error colors
        error: {
          light: '#f87171', // red-400
          DEFAULT: '#ef4444', // red-500
          dark: '#dc2626', // red-600
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