if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.fontfamily = {
	init: function ()
	{
		var fonts = [ 'Arial','Arial Black','Impact','Helvetica', 'Georgia', 'Times New Roman', 'Monospace','Verdana','Comic Sans MS','Trebuchet MS'];
		var that = this;
		var dropdown = {};

		$.each(fonts, function(i, s)
		{
			dropdown['s' + i] = { title: s, callback: function() { that.setFontfamily(s); }};
		});

		dropdown['remove'] = { title: 'Remove font', callback: function() { that.resetFontfamily(); }};

		this.buttonAdd('fontfamily', 'Change font family', false, dropdown);
	},
	setFontfamily: function (value)
	{
		this.inlineSetStyle('font-family', value);
	},
	resetFontfamily: function()
	{
		this.inlineRemoveStyle('font-family');
	}
};