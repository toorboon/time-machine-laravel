$(document).ready(function(){

// Add event-listeners
	// event-listener for the "Restart" button
	$('#restart_button').on('click', startGame);

// Set up the environment for playing the game
	var startBoard;
	const player1 = 'O';
	const player2 = 'X';
	const winCombos = [
		[0,1,2],
		[3,4,5],
		[6,7,8],
		[0,3,6],
		[1,4,7],
		[2,5,8],
		[0,4,8],
		[2,4,6]
	]
	const cells = document.querySelectorAll('.cell');
	startGame();

	function startGame() {
		document.querySelector(".endgame").classList.remove("d-flex");
		document.querySelector(".endgame").classList.add("d-none");
		startBoard = Array.from(Array(9).keys());
		for (var i=0; i < cells.length; i++){
			cells[i].innerText = '';
			cells[i].style.removeProperty('background-color');
			cells[i].addEventListener('click', turnClick, false);
		}
	}

	function turnClick(square){
		if (typeof startBoard[square.target.id] == 'number'){
			turn(square.target.id, player1);
			if (!checkTie()) turn(bestSpot(), player2);
		}
	}

	function turn(squareId, player){
		// squareId = squareId.substring(4,4);
		startBoard[squareId] = player;
		document.getElementById(squareId).innerText = player;
		let gameWon = checkWin(startBoard, player);
		if (gameWon) gameOver(gameWon);
	}

	function checkWin(board, player){
		let plays = board.reduce((a, e, i) => 
			(e === player) ? a.concat(i) : a, []);
		//console.log('plays: '+plays)
		let gameWon = null;
		for (let [index, win] of winCombos.entries()){
			if (win.every(elem => plays.indexOf(elem) > -1)) {
				gameWon = {index:index, player:player};
				//console.log(gameWon)
				//console.log(elem)
				//console.log(win.every(elem => plays.indexOf(elem > -1)))
				break;
			}
		}
		return gameWon;
	}

	function gameOver(gameWon){
		for (let index of winCombos[gameWon.index]){
			document.getElementById(index).style.backgroundColor = gameWon.player == player1 ? "#66ccff" : "red";
		}
		for (var i=0; i < cells.length; i++) {
			cells[i].removeEventListener('click', turnClick, false);
		}
		declareWinner(gameWon.player == player1 ? "Player 1 win!" : "Player 2 win!");
	}

	function declareWinner(who) {
		document.querySelector(".endgame").classList.remove("d-none");
		document.querySelector(".endgame").classList.add("d-flex");
		document.querySelector(".endgame .text").innerText = who;
	}

	function emptySquares() {
		return startBoard.filter(square => typeof square == 'number');
	}

	function bestSpot() {
		return emptySquares()[0];
	}

	function checkTie() {
		if (emptySquares().length == 0) {
			for (var i=0; i < cells.length; i++){
				cells[i].style.backgroundColor = "green";
				cells[i].removeEventListener('click', turnClick, false);
			}
			declareWinner("Tie Game!")
			return true;
		}
	}
// stopped at 35:15 of video
}); //end of $(document).ready(function()