/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      backgroundImage: theme => ({
        'custom-bg': "url('/img/fuk.php')", // PHPファイルのパスを正しく設定してください
      })
    },
  },
  plugins: [],
}

