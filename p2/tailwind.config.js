module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      keyframes: {
        flip: {
          '0%': { 
            transform: 'rotateY(0deg)',
          },
          '100%': {
            transform: 'rotateY(-180deg)',
          }
        },
        fadein: {
          '0%': {
            opacity: 0,
          },
          '100%': {
            opacity: 1,
          }         
        }
      },
      animation: {
        flip3: 'flip linear 1.5s 3 forwards alternate',
        flip4: 'flip linear 1s 4 forwards alternate',
        flip5: 'flip linear .5s 5 forwards alternate',
        flip6: 'flip linear 1s 6 forwards alternate',
        flip7: 'flip linear .5s 7 forwards alternate',
        flip8: 'flip linear 1s 8 forwards alternate',
        flip9: 'flip linear .5s 9 forwards alternate',
        flip10: 'flip linear .5s 10 forwards alternate',
        fadein: 'fadein 4s linear 5s 1 forwards'
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
