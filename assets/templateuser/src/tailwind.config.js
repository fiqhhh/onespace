module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  purge: [],
  theme: {
    extend: {
      fontFamily: {
        sans: ['poppins']
      },
      colors: {
        primary: {
          100: '#E9E7FC',
          200: '#8094FF',
          300: '#1947E5',
        },
        secondary: {
          100: '#969BAB',
          200: '#474A57',
          300: '#18191F',
        },
        tertiary: {
          100: '#FFF4CC',
          200: '#FFD465',
          300: '#FFBD12',
        },
        danger: {
          100: '#FFE8E8',
          200: '#FF9692',
          300: '#F95A2C',
        },
        success: {
          100: '#D6FCF7',
          200: '#61E4C5',
          300: '#00C6AE',
        }
      },
      borderRadius: {
        primary: '15px',
      },
    },
  },
  variants: {},
  plugins: [],
}
