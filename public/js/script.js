function hidePanel() {
    $(".home-content-table").fadeOut(1000);
    playMusic();
}

// Putar Musik Backsound
function playMusic() {
    var audio = document.getElementById("background-music");
    audio.play();

    audio.addEventListener('ended', function() {
        audio.currentTime = 0;
        audio.play();
    });
}

// Play Pause Backsound
function playPause() { 
    var audio = document.getElementById("background-music");
    
    if (audio.paused) {
        audio.play();
    } else {
        audio.pause();
    }
}

// Buka Tutup Menu Sidebar
function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

// Load Scene Ketika di Klik
$(document).ready(function() {
    $('#scenesContainer .scenes-list li').click(function() {
        var sceneId = $(this).data('scene-id');
        loadScene(sceneId);
    });
});

// Sidebar Menu
$('#gedungSelect').change(function() {
    var gedungId = $(this).val();
    $('#scenesContainer .scenes-list').hide();
    $('#gedung' + gedungId + 'Scenes').show();
    $('#sceneContainer').empty();

    $.ajax({        
        type: 'GET',
        success: function(response) {
            if (response.scenes && typeof response.scenes === 'object') {
              Object.keys(response.scenes).forEach(function(key) {
                var scene = response.scenes[key];
                $('#sceneContainer').append('<a class="smoothscroll" onclick="loadScene(' + scene.id + ')">' + scene.title + '</a><br>');
              });
            } else {
              console.log('response.scenes is not an array');
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});

function loadScene(clicked_id){
    load.loadScene(clicked_id);
}