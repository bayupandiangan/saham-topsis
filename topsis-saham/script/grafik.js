let currentWidget = null;

function renderChart(symbol) {
  document.getElementById("tv_chart_container").innerHTML = "";

  new TradingView.widget({
    container_id: "tv_chart_container",
    width: "100%",
    height: 500,
    symbol: "IDX:" + symbol,
    interval: "D",
    timezone: "Asia/Jakarta",
    theme: "light",
    style: "1",
    locale: "id",
    toolbar_bg: "#f1f3f6",
    enable_publishing: false,
    allow_symbol_change: false,
    studies: ["MACD@tv-basicstudies"],
    details: true
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const items = document.querySelectorAll(".saham-item");

  items.forEach((item, idx) => {
    item.addEventListener("click", function () {
      items.forEach(i => i.classList.remove("saham-active"));
      this.classList.add("saham-active");

      const kode = this.getAttribute("data-kode");
      renderChart(kode);
    });

    if (idx === 0) item.click(); // Auto load saham pertama
  });
});
