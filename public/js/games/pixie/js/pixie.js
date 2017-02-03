game.Pixie = me.Entity.extend({
	init: function () {
		var image = me.loader.getImage("pixie");
		this._super(me.Entity, "init", [me.game.viewport.width / 2 - image.width / 4, me.game.viewport.height - image.height, {
			image: "pixie",
			width: 186,
			height: 135
		}]);
		this.answer = 0;
		this.font = new me.Font("Arial", 32, '#DDD', "center");
		
		this.initAnimation();
	},
	
	initAnimation: function () {
		this.renderable.addAnimation("sleeping", [0,1], 800);
		this.renderable.setCurrentAnimation("sleeping");
	},
	
	update: function (time) {
		
			// numeric inputs
			if(this.answer < 1000) {
				if (me.input.isKeyPressed("in1")) {
					this.answer = this.answer*10+1;
				}
				else if (me.input.isKeyPressed("in2")) {
					this.answer = this.answer*10+2;
				}
				else if (me.input.isKeyPressed("in3")) {
					this.answer = this.answer*10+3;
				}
				else if (me.input.isKeyPressed("in4")) {
					this.answer = this.answer*10+4;
				}
				else if (me.input.isKeyPressed("in5")) {
					this.answer = this.answer*10+5;
				}
				else if (me.input.isKeyPressed("in6")) {
					this.answer = this.answer*10+6;
				}
				else if (me.input.isKeyPressed("in7")) {
					this.answer = this.answer*10+7;
				}
				else if (me.input.isKeyPressed("in8")) {
					this.answer = this.answer*10+8;
				}
				else if (me.input.isKeyPressed("in9")) {
					this.answer = this.answer*10+9;
				}
				else if (me.input.isKeyPressed("in0")) {
					this.answer = this.answer*10;
				}
			}
		
			// enter and backspace handlers
			if (me.input.isKeyPressed("erase")) {
				this.answer = Math.floor(this.answer/10);
			}
			else if (me.input.isKeyPressed("valid")) {
				if(me.game.world.getChildAt(1).solution == this.answer) {
					me.game.world.removeChild(me.game.world.getChildAt(1));
					game.data.score += 100;
				}
				this.answer = 0;
			}
		
		//default update code
		if (this.renderable) {
				return this.renderable.update(time);
		}
		return me.Renderable.prototype.update.apply(this, [time]);
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
		this.font.draw(renderer, this.answer, this.pos.x+56, this.pos.y+48);
  }
});