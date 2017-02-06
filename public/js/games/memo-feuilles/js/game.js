var game = {
	
		data : {
			score : 0,
			chrono : 0
		},
	
    // Run on page load.
    onload : function () {
        // Initialize the video.
        if (!me.video.init(640, 480, {wrapper : "screen", scale : 'auto'})) {
            alert("Your browser does not support HTML5 canvas.");
            return;
        }

        // add "#debug" to the URL to enable the debug Panel
        if (me.game.HASH.debug === true) {
            window.onReady(function () {
                me.plugin.register.defer(this, me.debug.Panel, "debug", me.input.KEY.V);
            });
        }

        // Initialize the audio.
        me.audio.init("mp3,ogg");

        // Set a callback to run when loading is complete.
        me.loader.onload = this.loaded.bind(this);

        // Load the resources.
        me.loader.preload(game.resources);
			
				// Initialize melonJS and display a loading screen.
        me.state.change(me.state.LOADING);
        },

    // Run on game resources loaded.
    loaded : function () {
			// set the Title Screen Object
			this.titleScreen = new game.TitleScreen();
			me.state.set(me.state.MENU, this.titleScreen);
			
			// set the Game Screen Object
			this.playScreen = new game.PlayScreen();
			me.state.set(me.state.PLAY, this.playScreen);
			
			// set the Gameover Screen Object
			this.gameoverScreen = new game.GameoverScreen();
			me.state.set(me.state.GAMEOVER, this.gameoverScreen);
			
			me.pool.register("bot", game.Bot);
			me.pool.register("panel", game.Panel);

			// start the game
			me.state.change(me.state.MENU);
    }
};
