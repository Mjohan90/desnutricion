// Grafico con track line:
// -> se agrega linea vertical que sigue al cursor para indicar los valores
Chart.defaults.LineWithLine    = Chart.defaults.line;
Chart.controllers.LineWithLine = Chart.controllers.line.extend({
    draw: function (linea) {
        Chart.controllers.line.prototype.draw.call(this, linea);

        if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
            var activePoint = this.chart.tooltip._active[0],
                ctx         = this.chart.ctx,
                x           = activePoint.tooltipPosition().x,
                topY        = this.chart.scales['y-axis-0'].top,
                bottomY     = this.chart.scales['y-axis-0'].bottom;

            // draw line
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(x, topY - 10);
            ctx.lineTo(x, bottomY + 10);
            ctx.lineWidth   = 1;
            ctx.strokeStyle = '#00c2cc';
            ctx.stroke();
            ctx.restore();
        }
    }
});