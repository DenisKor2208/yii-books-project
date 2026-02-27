function switchTab(tabId) {
	document.querySelectorAll('.page-section').forEach(section => {
		section.classList.remove('active')
	})

	document.getElementById(tabId).classList.add('active')

	document.querySelectorAll('.nav-link').forEach(link => {
		link.classList.remove('active')
		if (
			link.getAttribute('onclick') &&
			link.getAttribute('onclick').includes(tabId)
		) {
			link.classList.add('active')
		}
	})
	window.scrollTo(0, 0)
}
