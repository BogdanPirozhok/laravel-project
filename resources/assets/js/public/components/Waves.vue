<template>
    <div class="wave">
        <canvas :ref="id" />
    </div>
</template>
<script>
export default {
	name: 'Waves',
	props: {
		colorWave: {
			type: String,
			default: null
		},
		id: {
			type: String,
			default: null
		}
	},
	data(){
		return {
			htmlCanvas: null,
			container: null,
			ctx: null,
			screenWidth: null,
			screenHeight: null,
			wave: {},
			wave2: {},
			wave3: {},
			waves: {},
			waveLength: 0,
			moveWavesId: null,
		}
	},
	mounted() {

		this.htmlCanvas = this.$refs[this.id];
		this.container = this.$refs[this.id].closest('.wave');
		this.ctx = this.htmlCanvas.getContext('2d');
		window.addEventListener('resize', this.recalculateCanvas);
		window.addEventListener('orientationchange', this.recalculateCanvas);
		window.removeEventListener("unload", this.recalculateCanvas);

		this.recalculateCanvas();
		window.requestAnimationFrame(this.draw);
	},
	methods: {
		value(x, width, numberOfWaves) {
			x = x * numberOfWaves / width * 2 * Math.PI;
			return Math.sin(x);
		},
		multiplier(x, width) {
			let multiplierVar = 90;

			if (x <= width / 2) {
				return x * multiplierVar * 2 / width;
			}
			return width * multiplierVar / 2 / x;
		},
		randomIntFromInterval(min, max) {
			return Math.floor(Math.random() * (max - min + 1) + min);
		},
		draw() {
			this.ctx.clearRect(0, 0, this.screenWidth, this.screenHeight);
			this.ctx.beginPath();
			this.ctx.moveTo(this.screenWidth, this.screenHeight);

			for (let x = this.waveLength - 1; x > 0; x--) {
				this.ctx.lineTo(x, this.waves[x])
			}

			let gradient = this.ctx.createLinearGradient(0, 0, 0, this.screenHeight);
			gradient.addColorStop(1, this.colorWave);
			this.ctx.fillStyle = gradient;
			this.ctx.lineTo(0, this.screenHeight);
			this.ctx.fill();

			window.requestAnimationFrame(this.draw);
		},
		initializeWaves() {
			let randomWaves1 = this.randomIntFromInterval(4, 5);
			let randomWaves2 = this.randomIntFromInterval(2, 3);
			let randomWaves3 = this.randomIntFromInterval(6, 7);

			for (let x = 0; x < this.screenWidth; x++) {
				this.wave[x] = this.value(x, this.screenWidth, randomWaves1) * this.multiplier(x, this.screenWidth) / 4;
				this.wave2[x] = this.value(x, this.screenWidth, randomWaves2) * this.multiplier(x * 3, this.screenWidth) / 6;
				this.wave3[x] = this.value(x, this.screenWidth, randomWaves3);
			}
			this.waveLength = Object.keys(this.wave).length;
		},
		moveWaves() {
			if (!this.waveLength) {
				this.initializeWaves();
			}

			for (let x = this.waveLength - 1; x >= 0; x--) {
				if (x === 0) {
					this.wave2[x] = this.wave2[this.waveLength - 1];
					this.wave3[x] = this.wave3[this.waveLength - 1];
				} else {
					this.wave2[x] = this.wave2[x - 1];
					this.wave3[x] = this.wave3[x - 1];
				}

				this.waves[x] = this.wave[x] + this.wave2[x] + this.wave3[x] + this.screenHeight / 2;
			}
		},
		startLoop() {
			clearInterval(this.moveWavesId);
			this.moveWavesId = setInterval(this.moveWaves, 8000 / this.screenWidth);

		},
		recalculateCanvas() {
			let containerInfo = this.container.getBoundingClientRect();
			this.screenWidth = containerInfo.width;
			this.screenHeight = containerInfo.height * 1.3;
			this.htmlCanvas.height = this.screenHeight;
			if (window.matchMedia("(max-width: 991px)").matches) {
				this.htmlCanvas.width = this.screenWidth / 2.5;
			} else {
				this.htmlCanvas.width = this.screenWidth;
			}


			this.wave = {};
			this.wave2 = {};
			this.wave3 = {};
			this.waveLength = 0;
			this.waves = {};

			this.startLoop();
		},
	}
}
</script>
