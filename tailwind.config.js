/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"./assets/**/*.js",
		"./templates/**/*.html.twig"
	],
	theme: {
		extend: {
			colors: {
				'greenc': '#00BFA5',
				'greenh': '#008C79',
				'black': '#191919',
			},
			height: {
				'50vh': '50vh',
				'75vh': '75vh'
			},
			backgroundImage: {
				'hokusai': "url('/public/img/hokusai.png')",
				'leslutinstournes': "url('/public/img/leslutinstournes.png')",
				'mltoiturecreation': "url('/public/img/mltoiturecreation.png')"
			}
		},
	},
	plugins: [],
}
