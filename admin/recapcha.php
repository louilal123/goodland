<script src="https://www.google.com/recaptcha/api.js?render=6Lep8ZIqAAAAAMwIexA0yySzdpGQ_Z0qvSQtjXkv"></script>
<script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Lep8ZIqAAAAAMwIexA0yySzdpGQ_Z0qvSQtjXkv', {action: 'submit'}).then(function(token) {
          });
        });
      }
  </script>