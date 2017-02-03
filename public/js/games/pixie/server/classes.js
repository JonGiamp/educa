module.exports = {
	
	//*************** ROOM ******************

	Room: function (ownerName,ownerId) {
		
		this.owner = ownerName;
		this.players = [new Player(ownerName,ownerId),{},{},{}] //position of the players, also defines the color : 0=blue,1=green,2=red,3=purple
		this.clouds = [[],[],[],[]]; //arrays of clouds for every players
		
	},

	//**************** CLOUD ******************

	Cloud: function (x,difficulty) {
		
		//TODO-TOCLEAN
		this.x = x;
		this.y = 0;
		this.vy = 0.2+difficulty/20;
		this.solution = Math.round(Math.random()*15+5);
		this.a = Math.round(Math.random()*(this.solution-1)+1);
		this.b = this.solution - this.a;
			
	},
	
	//**************** PLAYER ******************
	
	Player: function (userName,userId) {
		
		//Requête Ajax
		
		var ajaxResponse = {
			difficulty:1
		}
		
		this.username = userName;
		this.clientId = userId;
		this.difficulty = ajaxResponse.difficulty; //0,1,2,3,4,5 => unknown,CP,CE1,CE2,CM1,CM2
		this.ready = false; //if the player is ready to start the game
		this.score = 0;
		this.answer = 0;
		
	}
};

/****************** INTERNAL FUNCTIONS *******************/

//*************** PLAYER ******************

	function Player (userName,userId) {
		
		//Requête Ajax
		
		var ajaxResponse = {
			difficulty:1
		}
		
		this.username = userName;
		this.clientId = userId;
		this.difficulty = ajaxResponse.difficulty; //0,1,2,3,4,5 => unknown,CP,CE1,CE2,CM1,CM2
		this.ready = false; //if the player is ready to start the game
		this.score = 0;
		this.answer = 0;
		
	}

	



