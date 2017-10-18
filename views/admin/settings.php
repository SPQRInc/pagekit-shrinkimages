<?php $view->script( 'settings', 'spqr/shrinkimages:app/bundle/settings.js', [ 'vue' ] ); ?>

<div id="settings" class="uk-form uk-form-horizontal" v-cloak>
	<div class="uk-grid pk-grid-large" data-uk-grid-margin>
		<div class="pk-width-sidebar">
			<div class="uk-panel">
				<ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
					<li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'General' | trans }}</a></li>
					<li><a><i class="uk-icon-puzzle-piece uk-margin-right"></i> {{ 'Exclusions' | trans }}</a></li>
				</ul>
			</div>
		</div>
		<div class="pk-width-content">
			<ul id="tab-content" class="uk-switcher uk-margin">
				<li>
					<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
						<div data-uk-margin>
							<h2 class="uk-margin-remove">{{ 'General' | trans }}</h2>
						</div>
						<div data-uk-margin>
							<button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}
							</button>
						</div>
					</div>
					<div class="uk-form-row">
						<div class="uk-alert uk-alert-warning">{{ 'This extension is going to optimize and overwrite all images that
							are stored in the storage folder. Please make sure that you have a backup, before using
							this extension' | trans }}
						</div>
					</div>
					<div class="uk-form-row">
						<button v-if="!progress" class="uk-button uk-button-secondary uk-button-large" @click.prevent="performShrinking">
							<span>{{ 'Shrink' | trans }}</span>
						</button>
						<button v-else class="uk-button uk-button-secondary uk-button-large" disabled>
							<span><i class="uk-icon-spinner uk-icon-spin"></i> {{ 'Shrinking' | trans }}</span>
						</button>
					</div>
				</li>
				<li>
					<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
						<div data-uk-margin>
							<h2 class="uk-margin-remove">{{ 'Exclusions' | trans }}</h2>
						</div>
						<div data-uk-margin>
							<button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}
							</button>
						</div>
					</div>
					<form class="uk-form uk-form-stacked" v-validator="formExclusions" @submit.prevent="add | valid">
						<div class="uk-form-row">
							<div class="uk-grid" data-uk-margin>
								<div class="uk-width-large-1-2">
									<input class="uk-input-large"
									       type="text"
									       placeholder="{{ 'Path' | trans }}"
									       name="exclusion"
									       v-model="newExclusion"
									       v-validate:required>
									<p class="uk-form-help-block uk-text-danger" v-show="formExclusions.exclusion.invalid">
										{{ 'Invalid value.' | trans }}</p>
								</div>
								<div class="uk-width-large-1-2">
									<div class="uk-form-controls">
										<span class="uk-align-right">
											<button class="uk-button" @click.prevent="add | valid">
												{{ 'Add' | trans }}
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
					</form>
					<hr />
					<div class="uk-alert"
					     v-if="!config.exclusions.length">{{ 'You can add your first exclusion using the input field above. Go ahead!' | trans }}
					</div>
					<ul class="uk-list uk-list-line" v-if="config.exclusions.length">
						<li v-for="exclusion in config.exclusions">
							<input class="uk-input-large"
							       type="text"
							       placeholder="{{ 'Path' | trans }}"
							       v-model="exclusion">
							<span class="uk-align-right">
								<button @click="remove(exclusion)" class="uk-button uk-button-danger">
									<i class="uk-icon-remove"></i>
								</button>
							</span>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>