module.exports = {
	/**
	 * grunt-wp-i18n
	 *
	 * Internationalize WordPress themes and plugins.
	 *
	 * @link https://www.npmjs.com/package/grunt-wp-i18n
	 */
	prod: {
		options: {
			domainPath: '/i18n/languages/',
			potFilename: 'wc_recommender.pot',
			type: 'wp-plugin'
		}
	}
};
