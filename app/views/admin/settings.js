window.settings = {

	el: '#settings',

	data: {
		config: $data.config,
		progress: false
	},

	methods: {
		save: function () {
			this.$http.post ('admin/shrinkimages/save', {config: this.config}, function () {
				this.$notify ('Settings saved.');
			}).error (function (data) {
				this.$notify (data, 'danger');
			});
		},
		add: function add (e) {
			e.preventDefault ();
			if (!this.newExclusion) return;

			this.config.exclusions.push (this.newExclusion);
			this.newExclusion = '';
		},
		remove: function (exclusion) {
			this.config.exclusions.$remove (exclusion);
		},
		prepareShrinking: function prepareShrinking (id) {
			return this.$http.post ('api/shrinkimages/shrinkimage/prepare').then (function (res) {
				return res;
			}, function (res) {
				this.$notify (res.data.message, 'danger');
				this.progress = false;
				return false;
			});
		},
		shrinkFiles: function shrinkFiles(files) {
			return this.$http.post('api/shrinkimages/shrinkimage/shrink', { files: files }).then(function (res) {
				if (res.data.files.length > 0) {
					return this.shrinkFiles(res.data.files);
				} else {
					return true;
				}
			}, function (res) {
				this.$notify(res.data.message, 'danger');
				this.progress = false;
				return false;
			});
		},
		performShrinking: function performShrinking () {
			this.progress = true;
			this.$notify ('Image shrinking is in progress. Please stand by until the "Images shrinked"-message shows up.', {
				status: 'warning',
				timeout: 0
			});
			this.prepareShrinking ().then (function (res) {
				this.shrinkFiles(res.data.files).then(function () {
					this.progress = false;
					this.$notify('Image shrinking completed.', { status: 'success', timeout: 0 });
				});
			}, function (res) {
				this.$notify (res, 'danger');
				this.progress = false;
			});
		}
	},
	components: {}
};

Vue.ready (window.settings);