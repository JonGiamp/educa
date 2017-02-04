/***** HERE SCRIPT ****/

function getParams(param) {
  var vars = {};
  window.location.href.replace( location.hash, '' ).replace(
    /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
    function( m, key, value ) { // callback
      vars[key] = value !== undefined ? value : '';
    }
  );

  if ( param ) {
    return vars[param] ? vars[param] : null;
  }
  return vars;
}

function ChangeUrl(title, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
    } else {
        alert("Browser does not support HTML5.");
    }
}

var params = {
  id_game: getParams('idg'),
  game_name: getParams('gnme'),
  id_user: getParams('idu'),
  game_level: getParams('glvl'),
  user_name: getParams('uname'),
  user_score: 0
}

var token = getParams('token');

ChangeUrl('Pixie', 'index.html');

function sendScore(score) {
  params.user_score = score;
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token
    }
  });

  $.ajax({
    type: "POST",
    url: '../../../api/post_rank',
    data: {
      '_token': token,
      'id_game': params.id_game,
      'game_name': params.game_name,
      'id_user': params.id_user,
      'game_level': params.game_level,
      'user_name': params.user_name,
      'user_score': params.user_score
     },
    success: function() {
      console.log("ok");
    },
    error: function() {
      console.log("problem");
    }
  })
};
