<footer class="bg-footer">
    <div class="contenedor centr">
      <h2 class="derechos title-header">Todos los derechos reservados <?php echo date('Y') ?> &copy;</h2>
    </div>
  </footer>
  <script src="/js/app.js"></script>
<script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '685b6cf985cda19294f9d1d4' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production',
          voice: {
            url: "https://runtime-api.voiceflow.com"
          }
        });
      }
      v.src = "https://cdn.voiceflow.com/widget-next/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script>
</body>
</html>
