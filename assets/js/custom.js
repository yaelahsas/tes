"use strict";

const stars = document.querySelectorAll(".star");
const rating = document.getElementById("rating");
const tulisanText = document.getElementById("tulisan");
const submitBtn = document.getElementById("submit");
const reviewsContainer = document.getElementById("reviews");
const loadingIndicator = document.getElementById('loading-indicator');

const allowedChars = /^[a-zA-Z0-9 .,?!-]*$/;

function showLoading() {
	loadingIndicator.style.display = 'block';
}

function hideLoading() {
	loadingIndicator.style.display = 'none';
}

let totalRatings = 0;
let ratingsCount = {
	1: 0,
	2: 0,
	3: 0,
	4: 0,
	5: 0
};

function sanitizeHTML(str) {
	const tempDiv = document.createElement('div');
	tempDiv.textContent = str;
	return tempDiv.innerHTML; S
}

function getReviews() {
	showLoading();
	fetch('https://rsudgenteng.banyuwangikab.go.id/web/home/ambil_review?inovasi=' + encodeURIComponent(inovasinya))
		.then(response => response.json())
		.then(data => {
			// Iterate through all reviews to calculate total ratings
			data.forEach(review => {
				ratingsCount[review.bintang]++;
				totalRatings++;
			});

			data.slice(0, 3).forEach(review => {
				const reviewElement = document.createElement("div");
				reviewElement.classList.add("review");
				reviewElement.innerHTML = `
                    <p><strong>Rating: ${sanitizeHTML(review.bintang.toString())}/5</strong></p>
                    <p>${sanitizeHTML(review.tulisan)}</p>
                    <p>Inovasi: ${sanitizeHTML(review.inovasi)}</p>
                    <p>Tanggal: ${sanitizeHTML(review.tanggal)}</p>`;
				reviewsContainer.appendChild(reviewElement);
			});
			updateBars();
		})
		.catch(error => {
			console.error('Error:', error);
			hideLoading();
		});
}

stars.forEach((star) => {
	star.addEventListener("click", () => {
		const value = parseInt(star.getAttribute("data-value"));
		rating.textContent = value;

		// Remove all existing classes from stars
		stars.forEach((s) => s.classList.remove("one", "two", "three", "four", "five"));

		// Add the appropriate class to each star based on the selected star's value
		stars.forEach((s, index) => {
			if (index < value) {
				s.classList.add(getStarColorClass(value));
			}
		});

		// Remove "selected" class from all stars
		stars.forEach((s) => s.classList.remove("selected"));
		// Add "selected" class to the clicked star
		star.classList.add("selected");
	});
});

submitBtn.addEventListener("click", () => {
	const tulisan = tulisanText.value;

	const userRating = parseInt(rating.textContent);
	const tanggal = new Date().toISOString().split('T')[0];

	if (!userRating || !tulisan || !inovasinya) {
		alert("Please select a rating and provide a review and innovation before submitting.");
		return;
	}

	if (!allowedChars.test(tulisan)) {
		alert("Review contains invalid characters. Please remove any special characters.");
		return;
	}

	const data = {
		tulisan: tulisan,
		bintang: userRating,
		inovasi: inovasinya,
		tanggal: tanggal
	};

	const formData = new FormData();
	for (const key in data) {
		if (data.hasOwnProperty(key)) {
			formData.append(key, data[key]);
		}
	}

	showLoading();
	fetch('https://rsudgenteng.banyuwangikab.go.id/web/home/tambah_review', {
		method: 'POST',
		body: formData
	})
		.then(response => response.json())
		.then(data => {
			console.log('Success:', data);

			const reviewElement = document.createElement("div");
			reviewElement.classList.add("review");
			reviewElement.innerHTML = `
                <p><strong>Rating: ${sanitizeHTML(userRating.toString())}/5</strong></p>
                <p>${sanitizeHTML(tulisan)}</p>
                <p>Inovasi: ${sanitizeHTML(inovasinya)}</p>
                <p>Tanggal: ${sanitizeHTML(tanggal)}</p>`;
			reviewsContainer.appendChild(reviewElement);

			// Update the rating bars
			ratingsCount[userRating]++;
			totalRatings++;
			updateBars();

			// Reset styles after submitting
			tulisanText.value = "";
			rating.textContent = "0";
			stars.forEach((s) => s.classList.remove("one", "two", "three", "four", "five", "selected"));
		})
		.catch(error => {
			console.error('Error:', error);
			hideLoading();
		});
});

function getStarColorClass(value) {
	switch (value) {
		case 1:
			return "one";
		case 2:
			return "two";
		case 3:
			return "three";
		case 4:
			return "four";
		case 5:
			return "five";
		default:
			return "";
	}
}

function updateBars() {
	hideLoading();
	const averageRating = (
		(5 * ratingsCount[5] +
			4 * ratingsCount[4] +
			3 * ratingsCount[3] +
			2 * ratingsCount[2] +
			1 * ratingsCount[1]) /
		totalRatings
	).toFixed(1);

	document.getElementById("average-rating").innerText = `${averageRating} rata-rata dari ${totalRatings} review.`;

	for (let i = 1; i <= 5; i++) {
		document.getElementById(`count-${i}`).innerText = ratingsCount[i];
		const bar = document.querySelector(`.bar-${i}`);
		bar.style.width = `${(ratingsCount[i] / totalRatings) * 100}%`;
	}
}

// Initial fetch to load reviews
getReviews();
