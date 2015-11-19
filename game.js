"use strict";

var numberOfBlocks = 9;
var targetBlocks = [];
var trapBlock = [];
var targetTimer = null;
var trapTimer = null;
var instantTimer = null;


document.observe('dom:loaded', function(){
	$("start").observe("click", readyGame);
	$("stop").observe("click", stopGame);
});

function readyGame(){ //초록버튼
	
	$("state").innerHTML = "Ready!";
	//state ready
	$("score").innerHTML = "0";
	//score 0
	clearInterval(instantTimer);
	//reset timer
	instantTimer = setTimeout(startGame(),3000);
	//call StartGame in 3sec
}	

function startGame(){
	clearInterval(instantTimer);
	targetBlocks = [];
	startToCatch();
}

function setTarget(){
	var rand = [];
	for (var i = 0; i < numberOfBlocks; i++) {
		rand[i] = Math.floor(Math.random()*9);
	}
}

function setTrap(){

}

function stopGame(){ //빨간버튼 //모든 글로벌변수들 초기화
	clearInterval(instantTimer);
	$("state").innerHTML = "Stop";

}

function startToCatch(){ //ex5 
	
}


for(var i = 0; i < numberOfTarget; i++) block[targetBlocks[i]].addClassName("target");
