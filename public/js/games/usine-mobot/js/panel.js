game.Panel = me.Entity.extend({
	init: function () {
		var image = me.loader.getImage("panel");
		this._super(me.Entity, "init", [me.game.viewport.width/2 - image.width/2, me.game.viewport.height - image.height, {
			image: "panel",
			width: image.width,
			height: image.height
		}]);
		
		//creating the panelButton object
		this.panelButton = me.GUI_Object.extend({
			
			 init:function (x,y,buttonType,callback)
			 {
				var settings = {}
				settings.image = buttonType+"_button";
				settings.framewidth = 90;
				settings.frameheight = settings.image.height;
				this._super(me.GUI_Object, "init", [x, y, settings]);
				this.pos.z = 100;
				this.callback = callback;
				this.globalAlpha = 0;
				this.anchorPoint.set(0,0);
				 
				this.renderable = new me.Sprite(this.pos.x,this.pos.y,{
					image : buttonType+"_button",
					framewidth : 90,
					frameheight : image.height
				});
				this.renderable.addAnimation("idle", [0], 1);
				this.renderable.addAnimation("hover", [1], 1);
				this.renderable.addAnimation("click", [2], 1);
				this.renderable.setCurrentAnimation("idle");
				this.renderable.anchorPoint.set(0,0);
				me.game.world.addChild(this.renderable,1000);
			 },
			
			update : function(time) {
				//default update code
				if (this.renderable) {
					return this.renderable.update(time);
				}
				return me.Renderable.prototype.update.apply(this, [time]);
			},
			
			onOut:function (event)
			{
				this.renderable.setCurrentAnimation("idle");
				return false;
			},
			
			onOver:function (event)
			{
				this.renderable.setCurrentAnimation("hover");
				return false;
			},

			onClick:function (event)
			{
				this.callback();
				this.renderable.setCurrentAnimation("click");
				return false;
			}
		});
		
		this.validButton = new this.panelButton(this.pos.x+3*this.width/4-45,this.pos.y-45,"good",function() {
			
			//check if the player pressed the correct button
			var correctAnswer = false;
			game.data.words.forEach(function(word){
				word.correct.forEach(function(variation) {
					if (variation == game.data.currentBot.solution) {
						correctAnswer = true;
					}
				});
			});
			
			//acting in consequence
			if(correctAnswer) {
				game.data.score += 100;
			}
			else {
				game.data.lives--;
				if(game.data.lives <= 0) {
					me.state.change(me.state.GAMEOVER);
				}
			}
			game.data.currentBot.solution = game.data.currentBot.initWord();
			
		});
		me.game.world.addChild(this.validButton,100);
		
		this.denyButton = new this.panelButton(this.pos.x+this.width/4-45,this.pos.y-45,"bad",function() {
			
			//check if the player pressed the correct button
			var correctAnswer = false;
			game.data.words.forEach(function(word){
				word.uncorrect.forEach(function(variation) {
					if (variation == game.data.currentBot.solution) {
						correctAnswer = true;
					}
				});
			});
			
			//acting in consequence
			if(correctAnswer) {
				game.data.score += 100;
			}
			else {
				game.data.lives--;
				if(game.data.lives <= 0) {
					me.state.change(me.state.GAMEOVER);
				}
			}
			game.data.currentBot.solution = game.data.currentBot.initWord();
			
		});
		me.game.world.addChild(this.denyButton,100);
	},
	
	draw: function (renderer) {
		var child = this.renderable;
		if (child instanceof me.Renderable) {
				// draw the child renderable's anchorPoint at the entity's
				// anchor point.  the entity's anchor point is a scale from
				// body position to body width/height
				var ax = this.anchorPoint.x * this.body.width,
						ay = this.anchorPoint.y * this.body.height;

				var x = this.pos.x + this.body.pos.x + ax,
						y = this.pos.y + this.body.pos.y + ay;

				renderer.translate(x, y);

				// apply the child transform, if any
				if (child.autoTransform === true && !child.currentTransform.isIdentity()) {
						// calculate the anchor point
						var bounds = child.getBounds();
						var cx = bounds.width * child.anchorPoint.x;
						var cy = bounds.height * child.anchorPoint.y;

						renderer.save();

						// translate to the anchor point
						renderer.translate(cx, cy);
						// apply the object transformation
						renderer.transform(child.currentTransform);
						// translate back
						renderer.translate(-cx, -cy);

						// draw the object
						child.draw(renderer);

						renderer.restore();

				} else {
						child.draw(renderer);
				}
				renderer.translate(-x, -y);
		}
  }
});