<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>


<!-- Fingerprint.Js -->

<script>
	// Initialize the agent at application startup.
	const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
		.then(FingerprintJS => FingerprintJS.load())

	// Get the visitor identifier when you need it.
	fpPromise
		.then(fp => fp.get())
		.then(result => {
		// This is the visitor identifier:
		const visitorId = result.visitorId
		console.log(visitorId)
    document.getElementById('fingerprint').value= visitorId;
		// alert(visitorId)
		})
	</script>