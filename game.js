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
	$("score").innerHTML = "0";
	clearInterval(instantTimer);
	clearInterval(targetTimer);
	clearInterval(trapTimer);
	setTimeout(startGame,3000);
}	

function startGame(){
	clearInterval(instantTimer);
	clearInterval(targetTimer);
	clearInterval(trapTimer);

	targetBlocks = [];
	trapBlock = null;

	var block = $$(".block");
	for(var i=0; i<block.length; i++) {
		block[i].removeClassName("target");
		block[i].removeClassName("trap");
	}
	startToCatch();
}

function stopGame(){ //빨간버튼 //모든 글로벌변수들 초기화
	$("state").innerHTML = "Stop";
	clearInterval(instantTimer);
	clearInterval(targetTimer);
	clearInterval(trapTimer);

	targetBlocks = [];
	trapBlock = null;

	var block = $$(".block");
	for(var i=0; i<block.length; i++) {	
		block[i].stopObserving();
	}
}

function startToCatch(){ //ex5 
	$("state").innerHTML = "Catch!";
	var block = $$(".block");
	var score = 0;

	setInterval(showTarget, 1000);
	setInterval(showTrap, 3000);


	for (var i = 0; i < numberOfBlocks.length; i++) {
		block[i].observe("click", function(){
			var score = $("score").innerHTML;
			score = Number(score);
			if(!this.hasClassName("target") && !this.hasClassName("trap")){
				score = score - 10;
				if(score < 0){
					score = 0;
				}
				this.addClassName("wrong");
				var ob = this;
				instantTimer = setTimeout(function(){
					ob.removeClassName("wrong");
				}, 100);
			}
			else if(this.hasClassName("target")){
				score = score + 20;
				this.removeClassName("target");
				for(var i=0; i<targetBlocks.length; i++){
					if(this == targetBlocks[i]) {
						targetBlocks.splice(i, 1);
					}
				}
			}
			else if(this.hasClassName("trap")){
				score = score - 30;
				if(score < 0){
					score = 0;
				}
				this.removeClassName("trap");
			}
			$("score").innerHTML = score;
		});
	}
}

function showTarget(){ // target 만들기
	if(targetBlocks.length < 5){

		var ran = Math.floor(Math.random() * 9);
		var blocks = $$(".block");

		while(blocks[ran].hasClassName("target")) {
			ran = Math.floor(Math.random() * 9);
		}
		blocks[ran].addClassName("target");
		targetBlocks.push(ran);

		if (targetBlocks.length > 4) {
			clearInterval(targetTimer);
			clearInterval(trapTimer);
			clearInterval(instantTimer);
			alert("You lose");
			for (var i = 0; i < numberOfBlocks; i++){
				blocks[i].stopObserving("click");
			}
			stopGame();
		}
	}
	
}

function showTrap(){ // trap 만들기
	var ran = Math.floor(Math.random() * 9);
	var blocks=$$(".block");

	while(targetBlocks.indexOf(ran) != -1) {
		ran = Math.floor(Math.random() * 9);
	}
	trapBlock=ran;
	blocks[ran].removeClassName("normal");
	blocks[ran].addClassName("trap");

	setTimeout(function() {
		trapBlock = null;
		blocks[ran].removeClassName("trap");
		blocks[ran].addClassName("normal");
	}, 2000);
}
