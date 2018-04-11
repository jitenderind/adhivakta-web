/**
 * 
 */
$.fn.extend(
{
	stringToList: function(listType)
	{
		var sentenceRegex = /[a-z0-9,'‘- ]+/igm, htmlList = '';
		$.each($(this).html().match(sentenceRegex), function(i, v)
		{
			/* Remove blank elements */
			if (v && (/[a-z0-9]+/igm.test(v)) && v != 'strong') 
			{
				htmlList += '' + v + '';
			}
		});
		htmlList += '';
		$(this).html(htmlList);
	}
});