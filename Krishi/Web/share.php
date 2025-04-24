<!DOCTYPE html>
<html>
<head>
    <title>Mobile Share Example</title>
</head>
<body>
    <button id="shareButton">Share</button>

    <script>
        document.getElementById("shareButton").addEventListener("click", function() {
            if (navigator.share) {
                // Use the Web Share API if supported
                navigator.share({
                    title: 'Shared Content',
                    text: 'Check out this amazing website!',
                    url: 'https://example.com',
                })
                .then(() => {
                    console.log('Shared successfully');
                })
                .catch((error) => {
                    console.error('Error sharing:', error);
                });
            } else {
                // Fallback for devices/browsers that don't support Web Share API
                console.log('Web Share API not supported.');
                // You can provide alternative sharing options or UI here
            }
        });
    </script>
</body>
</html>
