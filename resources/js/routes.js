import Mapp from './components/Map';
import MapStoreLocator from './components/MapStoreLocator';
export default {
    mode: 'history',
    routes: [{
            path: '/map',
            component: Mapp
        },
        {
            path: '/storelocator',
            component: MapStoreLocator
        }

    ]
}