import React from 'react';
import {Route, IndexRoute} from 'react-router';

import GeneralLayout from './layouts/GeneralLayout';
import HomePage from './pages/HomePage';
import Error503 from './pages/errors/Error503';

export const routes = (
    <div>
        <Route path='/client' component={GeneralLayout} onEnter={GeneralLayout.auth}>
            <IndexRoute component={HomePage}/>
        </Route>
        <Route path='/503' component={Error503}/>
    </div>
);
