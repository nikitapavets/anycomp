import React from 'react';
import {Route, IndexRoute} from 'react-router';

import HomePage from './pages/HomePage';

export const routes = (
    <div>
        <Route path='/'>
            <IndexRoute component={HomePage}/>
        </Route>
    </div>
);
