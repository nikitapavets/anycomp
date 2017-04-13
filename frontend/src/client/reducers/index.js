import {combineReducers} from 'redux';
import {routerReducer} from 'react-router-redux';

import basket from './basket';
import notebooks from './notebooks';
import tvs from './tvs';
import popularProducts from './popularProducts';
import breadcrumbs from './breadcrumbs';
import users from './users';

export default combineReducers({
    routing: routerReducer,
    basket,
    notebooks,
    tvs,
    popularProducts,
    breadcrumbs,
    users
});
