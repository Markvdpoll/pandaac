$(document).ready(function() {

	/* Reload Captcha */
	(function($) {
		var $submit  = $('[data-set="captcha"]'),
			$captcha = $('[data-get="captcha"]').find('img');

		$submit.on('click', function() {
			$captcha.attr('src', $captcha.attr('src') + '?' + Math.random());
			return false;
		});
	})($);



	/*
	$('a#tos').colorbox({
		href: SITEURL + "/ajax/tos",
		width: "60%",
		opacity: 0.5,
		speed: 150
	});

	// $('a#tos').redactor.modalInit();
	*/



	// Search Guilds or Characters
	var search_guild_character = {
		'guilds': ['Perfect Circle', 'Circle of Wisdom', 'Fellowship of Guardia', 'Pantheon', 'Red Rose', 'Satori', 'Phoenix', 'Violaint Saints', 'Wrath', 'Innervision'],
		'characters': ['Zudra', 'Passkontroll', 'Lennan', 'King Julien', 'Peter Dinklage', 'Baba Isa', 'Navelor', 'Trixx Drixx', 'Lejj']
	};

	$('form.search-guild-character input[name="search"]').autocomplete({
		source: function() {
			
		}
	});
	// END: Search Guilds or Characters



	/* WYSIWYG Editor (incl. syntax highlighter) */
	(function($) {
		var editor;
		var $redactor = $('.redactor').attr('name', 'code').attr('id', 'code').addClass('html').redactor({
			buttons: [
				'save', '|', 'source', /*'html',*/ '|', 'formatting', 'bold', 'italic', 'deleted', 'fontcolor', 'link', '|',
				'image', 'video', '|', 'unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 
				'alignleft', 'aligncenter', 'alignright', 'justify', '|', 'horizontalrule'
			],
			buttonsCustom: {
				save: {
					title: 'Save Changes',
					callback: function(obj, event, key) {
						var $editor = obj.$editor,
							content = $editor.html();

						alert('Content Saved!');
					}
				},
				source: {
					title: 'View Source',
					callback: function(obj, event, key) {
						var $editor = $('.redactor_editor');
						var $mirror = $('.CodeMirror');

						if ($editor.is(':visible')) {
							$editor.hide();
							editor.setValue($redactor.getCode());
							$mirror.show();
						} else {
							$mirror.hide();
							$redactor.setCode(editor.getValue());
							$editor.show();
						}
					}
				}
			}
		});

		if ($redactor.length > 0) {
			editor = CodeMirror(function(elt) {
				$redactor[0].parentNode.replaceChild(elt, $redactor[0]);
			}, {
				value: $redactor.getCode(),
				mode: "text/html", 
				tabMode: "indent", 
				theme: "blackboard",
				lineWrapping: true,
			});
			$('.CodeMirror').hide();
		}
	})($);
});