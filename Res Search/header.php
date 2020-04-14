<!DOCTYPE html>
<html lang="en" >
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<head>
  <meta charset="UTF-8">
  <title>Header Shrink on Scroll</title>

<style type="text/css">
.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: #000;
    color:#fff;
    z-index: 1000;
    height: 100px;
    overflow: hidden;
    transition: height 0.3s;
    text-align:center;
}
    
#index
{   color:#f0f0f0;
    font-size:20px;
    font-weight:normal;
    margin-left: 20px;
    margin-bottom: 30px;
    float: left;
}

#index:hover{
        color: yellow;
    }
    
#start_button {
    border: 0;
    background-color:gold;
    padding: 0;
    margin-left: 10px;
}

    #chat{
        display: flex;
    justify-content: center;
        width: auto;
        margin-top: 20px;
    }
    
  #btn {
	  background-color: #008CBA; 
	  border: none;
	  color: white;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
      margin-left: 10px;
      margin-top: 5px;
  }
    
    #btn:hover{
        background-color: aquamarine;
    }
    
</style>

    
</head>


<body>

  <div class="header">
  <a href="1.php" style=" text-decoration:none;" id="index"><div ><h1>Home</h1></div></a>
      <div id="chat">
      <div><input type="text" id="say" style="width:500px;height:50px; font-size:20pt" placeholder="Micro Chatbot"/></div>
    <div><button id="start_button" onclick="startButton(event)">
    <img id="start_img" src="mic.gif" alt="Start"></button></div>
      <div><input type="button" id="btn" onclick="directShow();" value="Request"/></div>
    </div>
    </div>


</body>
    

<script type="text/javascript">
  
var final_transcript = '';
var recognizing = false;
var ignore_onend;
var start_timestamp;
var speakingStatus;
rate=1;
volume=1;
	



if (!('webkitSpeechRecognition' in window)) {
  alert("upgrade");
} else {
	  	
	  start_button.style.display = 'inline-block';
	  var recognition = new webkitSpeechRecognition();


	  recognition.continuous = true;
	  recognition.interimResults = true;
	  
	  recognition.onstart = function() {
	    recognizing = true;
	    //showInfo('info_speak_now');
	    start_img.src = 'mic-animate.gif';
		
	  };
	  recognition.onerror = function(event) {
	    if (event.error == 'no-speech') {
	      start_img.src = 'mic.gif';
	      alert("Error:no speech detected!");
	      ignore_onend = true;
	    }
	    if (event.error == 'audio-capture') {
	      start_img.src = 'mic.gif';
	      alert("Error:Your microphone may be busy!");
	      ignore_onend = true;
	    }
	    if (event.error == 'not-allowed') {
	      if (event.timeStamp - start_timestamp < 100) {
	        alert("Error: Your microphone may be blocked.");
	      } else {
	        alert("Error: Your microphone may be denial.");
	      }
	      ignore_onend = true;
	    }
	  };
	  recognition.onend = function() {
	    recognizing = false;
	    if (ignore_onend) {
	      return;
	    }
	    start_img.src = 'mic.gif';
	    if (!final_transcript) {
	      //showInfo('info_start');
	      return;
	    }
	    //showInfo('');
	    if (window.getSelection) {
	      window.getSelection().removeAllRanges();
	      var range = document.createRange();
	      range.selectNode(document.getElementById('say'));
	      window.getSelection().addRange(range);
	    }
	    
	  };
	  recognition.onresult = function(event) {
	    var interim_transcript = '';
	    for (var i = event.resultIndex; i < event.results.length; ++i) {
	      if (event.results[i].isFinal) {
	        final_transcript = event.results[i][0].transcript;

			texttospeech(final_transcript);

			speakingStatus = "stopped";
			
			
	      } else {
	        interim_transcript = event.results[i][0].transcript;
	      }
	    }
        var text=document.getElementById('say');
	    final_transcript = capitalize(final_transcript);
	    text.value = linebreak(final_transcript);
	    say.value = linebreak(interim_transcript);
	    if (final_transcript || interim_transcript) {
	      showButtons('inline-block');
	    }
	  };
}

	
var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}
var first_char = /\S/;
function capitalize(s) {
  return s.replace(first_char, function(m) { return m.toUpperCase(); });
}

function startButton(event) {

	speakingStatus = "stopped";
  if (recognizing) {
    recognition.stop();
    return;
  }
  final_transcript = '';
  recognition.lang = "en-US";
  recognition.start();
  ignore_onend = false;
  say.innerHTML = '';
  start_img.src = 'mic-slash.gif';
  //showInfo('info_allow');
  showButtons('none');
  start_timestamp = event.timeStamp;
}

var current_style;
function showButtons(style) {
  if (style == current_style) {
    return;
  }
  current_style = style;
}

function texttospeech(dialog){  
    var words =["nearby restaurants","nearby canteens","surrounding restaurants","surrounding canteens","food"];
    var names=["joe","tim","john","peter","mary","bruce","tom"];
    dialog=dialog.toLowerCase();
    voices = window.speechSynthesis.getVoices();
    console.log('Get voices ' + voices.length.toString());
    for(var i = 0; i < voices.length; i++ ) {
	     console.log("Voice " + i.toString() + ' ' + voices[i].name);
    
	}
  
	   var sayText ="Sorry, I don't understand";
	   //document.getElementById("news").innerHTML="";
	   
//Introduction	
//Default answer
	   if(dialog=="hi"||dialog=="hello")
	   {
			 sayText ="Hello, How are you.";
		   	 
		}
	  
	
	   else if(dialog=="how to use the system" || dialog=="help")
	   {	
	   		 sayText = "This system uses chatbot and different API. You can talk to the system by clicking the microphone icon, or type your words and submit.";
		    
       }
 
//Show the current location.
	   else if(dialog.indexOf("location")!=-1){
		sayText = "I am checking your location, wait a minute";
        window.location.href='Get_Location.php';
	   }
    
       else if(dialog.indexOf("home page")!=-1){
		sayText = "Going back to home page.";
        window.location.href='1.php';
	   }
      
    else if(dialog=="recommend me the top three restaurants"){	
	   		showText = sayText = "What's your name?";
       }
    
    else if(words.indexOf(dialog)!=-1){	
           sayText="";
	   		window.location.href="Restaurant_nearby.php";
       }
    
    else if(names.indexOf(dialog)!=-1){
               sayText="";
            window.location.href="recommend_test.php?username="+dialog;
           }
    
    else if(dialog.indexOf("search for")!=-1){
		$.ajaxSetup({async: false});
		   		showText="";
		   		sayText="";
		   		
		   		 $.ajax({
                     url: "noun_phrase.php",
                     data: {text: dialog},
                     success: function (data) {
                         var target=data.match(/"[^"\\]*(?:\\[\s\S][^"\\]*)*"/g);
                         var reg = new RegExp('"',"g");
                         data = target[1].replace(reg, "");
                      window.location.href="place_search.php?target="+data;
                     }
		   		 });
	   }

//Give Answer with a speech
	  saysomething(sayText);
		
		//if the computer is responding, the system stops recognising speech.
	 	var u1 = new SpeechSynthesisUtterance(sayText);
       	u1.lang = 'en-US';
       	u1.pitch = 1;
       	u1.rate = 1;
       	u1.voice = voices[0];
       	u1.voiceURI = 'native';
       	u1.volume = 6;
		
		
		//if the computer is responding, the system stops recognising speech.
		u1.onstart = function(){

			recognition.stop();
			//reset();
		}
		//if the computer finishes responding, the system restarts recognising speech.
		u1.onend = function(event) {
			recognition.start();
			recognizing = true;
		 }
		
       	//speechSynthesis.speak(u1);
       	console.log("Voice " + u1.voice.name);
		
     
}
</script>


<script>



function saysomething(str) {
	var u = new SpeechSynthesisUtterance();
   			u.text = str ;
   			u.lang = 'en-AU';
   			u.rate = window.rate;
  			u.volume=window.volume;
  			speechSynthesis.speak(u);
}
 function directShow(){
      	var str = document.getElementById("say");
      	texttospeech(str.value);
      
      }


</script>
</html>