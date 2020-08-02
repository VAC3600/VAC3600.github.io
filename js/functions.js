var debugme;

function rating( id, ipport, direction, controlsum ) {
	if( direction == 'up' ) {
		url = '/ajax/ratingup/?security_key=32';
	}
	else {
		url = '/ajax/ratingdown/?security_key=32';
	}
	
	debugme = $.post( url, { addr: ipport, fun: controlsum }, function( result ) {
		if( result == 'up' || result == 'down' ) {
			var rating = parseInt( $("#r" + id).html() );
			if ( result == 'up' ) {
				rating++
			}
			else {
				rating--;
			}
			if( rating == 0 ) {
				$( "#r" + id ).html( "0" );
			}
			else {
				$( "#r" + id ).html( rating );
			}
		}
		else {
			switch( result ) {
				default:
				case '0':
					$('body').append('<div class="modal" style="margin-top:50px;box-shadow: 0 0 0 rgba(0, 0, 0, 0);background:transparent;border:0;"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().parent().hide();">&times;</button><h4>Ошибка!</h4>Ошибка.</div></div>')
					//alert( 'Ошибка' );
					break;
				case '1':
					$('body').append('<div class="modal" style="margin-top:50px;box-shadow: 0 0 0 rgba(0, 0, 0, 0);background:transparent;border:0;"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().parent().hide();">&times;</button><h4>Ошибка!</h4>Нельзя голосовать больше 10 раз в день.</div></div>')
					//alert( 'Нельзя голосовать больше 10 раз в день' );
					break;
				case '2':
					$('body').append('<div class="modal" style="margin-top:50px;box-shadow: 0 0 0 rgba(0, 0, 0, 0);background:transparent;border:0;"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().parent().hide();">&times;</button><h4>Ошибка!</h4>Вы уже голосовали сегодня.</div></div>')
					//alert( 'Вы уже голосовали сегодня' );
					break;
				case '3':
					$('body').append('<div class="modal" style="margin-top:50px;box-shadow: 0 0 0 rgba(0, 0, 0, 0);background:transparent;border:0;"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().parent().hide();">&times;</button><h4>Ошибка!</h4>Можно голосовать только один раз в день.</div></div>')
					//alert( 'Можно голосовать только один раз в день' );
					break;
			}
		}
	} );
	return;
}

function checkEmail( fieldObject ) {
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)([a-z.0-9]{2,15})+$/;
	if ( !filter.test( fieldObject.value ) ) {
		fieldObject.focus();
		fieldObject.select();
		$('body').append('<div class="modal" style="margin-top:50px;box-shadow: 0 0 0 rgba(0, 0, 0, 0);background:transparent;border:0;"><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().parent().hide();">&times;</button><h4>Ошибка!</h4>Неправильный адрес электронной почты.</div></div>')
		//alert( 'Неправильный адрес электронной почты' );
		return false;
	}
	else return true;
}

var OldColors = new Array(6);
function lightRow( cell ) {
	for( i = 0; i < ( cell.parentNode.cells.length );i++ ) {
		OldColors[i] = cell.parentNode.cells[i].style.backgroundColor;
		cell.parentNode.cells[i].style.backgroundColor = '#424242';
	}
}

function darkRow( cell ) {
	for( i = 0; i < ( cell.parentNode.cells.length );i++ ) {
		cell.parentNode.cells[i].style.backgroundColor = OldColors[i];
	}
}

function ch_lth() {
	s = 300 - $('#postsender').val().length;
	if( s < 0 ) {
		s_val = $('#postsender').val().substring(0, 300);
		$('#postsender').val(s_val);
		s = 0;
	}
	$('#postcounter').html(s);
	return;
}

function declension(intv, expressions) {
	if (expressions.Length < 3) {
		expressions[2] = expressions[1];
	}
	
	count = parseInt(intv + "") % 100;
	
	if (count >= 5 && count <= 20) {
		result = expressions['2'];
	}
	else {
		count = count % 10;
		if (count == 1) {
			result = expressions['0'];
		}
		else if (count >= 2 && count <= 4) {
			result = expressions['1'];
		}
		else {
			result = expressions['2'];
		}
	}

	return result;
}

jQuery( document ).ready( function($) {
	$('a[rel*=map]').facebox();
	$('a[rel*=userbars]').facebox();
	
	$("a").click(function () {
		if( $(this).attr("href") == '#getmore' ) {
			curpage++;
			
			$.get("/ajax/comments_more/" + server_id.toString() + "/" + curpage.toString() + "/", function(html) {
				$(".scomments").append(html);
			});
			
			if( curpage >= pageCount ) {
				$( this ).hide();
			}
			return false;
		}
	});
	
	$(".site_description").hide();
})