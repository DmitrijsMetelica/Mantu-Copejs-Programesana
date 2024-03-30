document.getElementById(".ko_cope").addEventListener("keydown", function(event) {
    // Pārbauda, vai CSS ir pieejams
    if (cssAvailable()) {
      // Ļauj ievadīt tekstu, ja ir pieejams CSS
      return;
    }
    // Bloķē ievadi, ja nav pieejams CSS
    event.preventDefault();
  });
  
  function cssAvailable() {
    // Pārbauda, vai ir definēts CSS stils
    // Šis ir vienkāršs pārbaudes piemērs; jūs varat pielāgot to saskaņā ar savām vajadzībām
    var styleSheets = document.styleSheets;
    for (var i = 0; i < styleSheets.length; i++) {
      var rules = styleSheets[i].cssRules;
      if (rules && rules.length > 0) {
        return true;
      }
    }
    return false;
  }
  