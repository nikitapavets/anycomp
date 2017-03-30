import React from 'react';
import {Route, IndexRoute} from 'react-router';

import GeneralLayout from './layouts/GeneralLayout';
import HomePage from './pages/HomePage';
import Error503 from './pages/errors/Error503';

export const routes = (
    <div>
        <Route path='/' component={GeneralLayout}>
            <IndexRoute component={HomePage} onEnter={HomePage.auth}/>
            <Route path='503' component={Error503}/>
        </Route>
    </div>
);
