import React from 'react';
import {Route, IndexRoute} from 'react-router';

import GeneralLayoutContainer from './components/GeneralLayout/GeneralLayoutContainer';
import GeneralLayout from './components/GeneralLayout/GeneralLayout';
import IndexContainer from './components/Index/IndexContainer';
import NotebooksPage from './pages/NotebooksPage';
import Error503 from './pages/errors/Error503';

export const routes = (
    <div>
        <Route path='/' component={GeneralLayoutContainer} onEnter={GeneralLayout.auth}>
            <IndexRoute component={IndexContainer}/>
            <Route path='/notebooks' component={NotebooksPage}/>
        </Route>
        <Route path='/503' component={Error503}/>
    </div>
);
