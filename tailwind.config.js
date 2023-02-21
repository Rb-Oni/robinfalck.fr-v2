/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ['./templates/**/*.html.twig'],
	theme: {
		extend: {
			colors: {
				'green': '#00BFA5',
				'black': '#191919',
			},
			height: {
				'50vh': '50vh'
			},
		},
	},
	plugins: [],
}
