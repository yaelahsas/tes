<!DOCTYPE html>
<html>

<head>
	<style>
		body {
			background-color: #000;
			overflow: hidden;
		}

		.leaf {
			position: absolute;
			width: 50px;
			height: 50px;
			background-color: #ff9900;
			border-radius: 50%;
		}
	</style>
</head>

<body>
	<div id="leaf-container"></div>

	<script>
		// Membuat daun secara dinamis
		function createLeaf() {
			const leaf = document.createElement("div");
			leaf.className = "leaf";
			leaf.style.left = Math.random() * window.innerWidth + "px";
			leaf.style.transform = "rotate(" + Math.random() * 360 + "deg)"; // Mengatur rotasi acak pada daun
			document.getElementById("leaf-container").appendChild(leaf);
		}

		// Menganimasikan daun jatuh
		function animateLeafFall() {
			const leaves = document.getElementsByClassName("leaf");
			for (let i = 0; i < leaves.length; i++) {
				const leaf = leaves[i];
				const speed = Math.random() * 3 + 1; // Kecepatan jatuh daun
				const position = leaf.getBoundingClientRect();
				const newY = position.top + speed;
				if (newY <= window.innerHeight) {
					leaf.style.top = newY + "px";
				} else {
					leaf.remove(); // Menghapus daun setelah mencapai batas bawah
				}
			}
			requestAnimationFrame(animateLeafFall);
		}

		// Membuat beberapa daun saat memuat halaman
		window.onload = function() {
			for (let i = 0; i < 100; i++) {
				createLeaf();
			}
			animateLeafFall();
		};
	</script>
</body>

</html>