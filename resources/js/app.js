import Alpine from "alpinejs"
import Mask from "@alpinejs/mask"
import Persist from "@alpinejs/persist"
import Focus from "@alpinejs/focus"
import Collapse from "@alpinejs/collapse"
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'

import "@fontsource/nunito";
import "@fontsource/nunito/300.css";
import "@fontsource/nunito/400.css";
import "@fontsource/nunito/500.css";
import "@fontsource/nunito/600.css";
import "@fontsource/nunito/700.css";

Alpine.plugin(Mask)
Alpine.plugin(Persist)
Alpine.plugin(Focus)
Alpine.plugin(Collapse)
Alpine.plugin(NotificationsAlpinePlugin)
Alpine.plugin(FormsAlpinePlugin)

window.Alpine = Alpine

Alpine.data('drawer', () => ({
    showDrawer: false,
    toggleDrawer() {
        this.showDrawer = !this.showDrawer;
    },
}))

Alpine.start()
