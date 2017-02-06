game.PlayScreen = me.ScreenObject.extend({
	/**
	 *  action to perform on state change
	 */
	onResetEvent: function() {
		me.game.world.addChild(new me.ColorLayer("background", "#2585BF"), 0);
		
		this.HUD = new game.HUD.Container();
    me.game.world.addChild(this.HUD);
		
		// reset number of moves done and init HUD
    game.data.moves = 0;
		game.data.tiles = [];
		
		this.coupleNumber = 6;
		this.couples = [];
		
		/* Selecting the pairs that'll be used for this game */
		
		//Deep-cloning the Json reference
		this.couplesModel = me.loader.getJSON("couples");
		this.couplesClone = [];
		
		for(var i=0; i<this.couplesModel.length; i++) {
			this.couplesClone.push({
				"id":this.couplesModel[i].id,
				"name":this.couplesModel[i].name
			});
		}
		
		for (var i=0; i<this.coupleNumber; i++) {
			
			var indexOfCoupleChosen = Math.floor(Math.random()*this.couplesClone.length);
			this.couples.push(this.couplesClone[indexOfCoupleChosen]);
			
			//shifting the this.couplesClone
			for(var j=indexOfCoupleChosen; j<this.couplesClone.length; j++) {
				this.couplesClone[j] = this.couplesClone[j+1];
			}
			this.couplesClone.splice(this.couplesClone.length-1,1);
			
		}
		
		/* Filling game.data.tiles with the leaf and text Tiles corresponding to the couples selected*/
		
		game.data.tiles[0] = new TextTile(16,38,0);
		me.game.world.addChild(game.data.tiles[0],3);
		
		for (var i=1; i<this.coupleNumber*2; i++) {
			
			var tileX = (i%4)*((me.game.viewport.width-16)/4)+16;
			var tileY = Math.floor(i/4)*((me.game.viewport.height-38)/3)+38;
			var pairId = i%this.coupleNumber;
			
			if(i < this.coupleNumber) {
				game.data.tiles[i] = new TextTile(tileX,tileY,pairId);
			}
			else {
				game.data.tiles[i] = new LeafTile(tileX,tileY,pairId);
			}
			me.game.world.addChild(game.data.tiles[i],3);
			
		}
		
		console.log(game.data.tiles);
		
		/* Randomizing tiles positions */
		
		for(var i=0; i<game.data.tiles.length; i++){
			var target = Math.floor(Math.random()*game.data.tiles.length);
			var tempX = game.data.tiles[i].pos.x;
			var tempY = game.data.tiles[i].pos.y;
			game.data.tiles[i].pos.x = game.data.tiles[target].pos.x;
			game.data.tiles[i].pos.y = game.data.tiles[target].pos.y;
			game.data.tiles[i].recenterRenderable();
			game.data.tiles[target].pos.x = tempX;
			game.data.tiles[target].pos.y = tempY;
			game.data.tiles[target].recenterRenderable();
		}

	},

	/**
	 *  action to perform when leaving this screen (state change)
	 */
	onDestroyEvent: function() {
		//remove HUD
    me.game.world.removeChild(this.HUD);
	}
});

/*************************************************/
/*********** ADDITIONALS CUSTOM OBJECTS **********/
/*************************************************/

/************ Tile with tree name ************/

var TextTile = me.GUI_Object.extend({

	 init:function (x,y,id)
	 {
		var settings = {}
		settings.image = "tile_bg";
		settings.framewidth = me.game.viewport/4-16;
		settings.frameheight = settings.framewidth;
		this._super(me.GUI_Object, "init", [x, y, settings]);
		this.pos.z = 2;
		this.status = "verso";
		this.pairId = id;
		 
		this.renderable = new (me.Renderable.extend({
			
			init:function (parentX,parentY)
			 {
				this._super(me.Renderable, "init", [parentX+4,parentY+4,120,120]);
				this.status = "verso";
				 console.log(id);
				 console.log(game.playScreen.couples[id]);
				this.text = game.playScreen.couples[id].name;
				this.font = new me.Font("Arial", 16, "#333", "center");
			 },
			
			draw : function(renderer) {
				if(this.status == "recto") {
					renderer.setColor("#DDD");
					renderer.fillRect(this.pos.x, this.pos.y, this.width, this.height);
					this.font.draw(renderer, this.text, this.pos.x+this.width/2, this.pos.y+this.height/2-8);
				}
			}
		}))(this.pos.x,this.pos.y);
		me.game.world.addChild(this.renderable,500);
	 },
	
	recenterRenderable : function() {
		this.renderable.pos.x = this.pos.x+4;
		this.renderable.pos.y = this.pos.y+4;
	},

	draw : function(renderer) {
		if (this.hover) {renderer.setColor("#AA3")}
		else {renderer.setColor("#333")}
		renderer.fillRect(this.pos.x, this.pos.y, this.width, this.height);
	},

	update : function(dt) {
		this.renderable.status = this.status;
		return true;
	},

	onClick:function (event)
	{
		if(this.status == "verso") {
			this.status = "recto";
			game.data.moves++;
			if(game.data.moves%2 == 0) {
				doesItPair();
			}
		}
		return false;
	}
});

/************ Tile with tree leaf ************/

var LeafTile = me.GUI_Object.extend({

	 init:function (x,y,id)
	 {
		var settings = {}
		settings.image = "tile_bg";
		settings.framewidth = me.game.viewport/4-32;
		settings.frameheight = settings.framewidth;
		this._super(me.GUI_Object, "init", [x, y, settings]);
		this.pos.z = 2;
		this.status = "verso";
		this.pairId = id;
		 
		this.renderable = new (me.Sprite.extend({
			
			init:function (parentX,parentY)
			{
				var settings = {};
				settings.image =  "leaf_"+game.playScreen.couples[id].id;
				settings.framewidth = 120;
				settings.frameheight = 120;
				this._super(me.Sprite, "init", [parentX, parentY, settings]);
				this.alpha = 0;
			},
			
		}))(this.pos.x+this.width/2,this.pos.y+this.height/2);
		 
		this.recenterRenderable();
		me.game.world.addChild(this.renderable,1000);
	 },
	
	recenterRenderable : function() {
		this.renderable.pos.x = this.pos.x+64;
		this.renderable.pos.y = this.pos.y+64;
		this.renderable.pos.y += (120-this.renderable.image.height)/2;
	},

	draw : function(renderer) {
		if (this.hover) {renderer.setColor("#AA3")}
		else {renderer.setColor("#333")}
		renderer.fillRect(this.pos.x, this.pos.y, this.width, this.height);
	},

	update : function(dt) {
		if(this.status == "verso") {
			this.renderable.setOpacity(0);
		}
		else if(this.status == "recto") {
			this.renderable.setOpacity(1);
		}
		return true;
	},

	onClick:function (event)
	{
		if(this.status == "verso") {
			this.status = "recto";
			game.data.moves++;
			if(game.data.moves%2 == 0) {
				doesItPair();
			}
		}
		return false;
	}
});

var doesItPair = function () {
	var pairId = -1;
	var firstTileIndex = -1;
	for(var i=0; i<game.data.tiles.length; i++) {
		if(game.data.tiles[i].status == "recto") {
			
			// record pairId of the first flipped tile
			if (pairId == -1) {
				pairId = game.data.tiles[i].pairId;
				firstTileIndex = i;
			}
			
			// check if the pairId matches the first one
			else {
				var index = i;
				setTimeout(function(){
					if (pairId == game.data.tiles[index].pairId) {
						game.data.tiles[firstTileIndex].status = "won";
						game.data.tiles[index].status = "won";
						me.game.world.removeChild(game.data.tiles[firstTileIndex].renderable);
						me.game.world.removeChild(game.data.tiles[firstTileIndex]);
						me.game.world.removeChild(game.data.tiles[index].renderable);
						me.game.world.removeChild(game.data.tiles[index]);
						var allWon = true;
						for (var j=0; j<game.data.tiles.length; j++) {
							if(game.data.tiles[j].status != "won") {
								allWon = false;
							}
						}
						if (allWon) {me.state.change(me.state.GAMEOVER);}
					}
					else {
						game.data.tiles[firstTileIndex].status = "verso";
						game.data.tiles[index].status = "verso";
					}
				}, 500);
			}
			
		}
	}
}