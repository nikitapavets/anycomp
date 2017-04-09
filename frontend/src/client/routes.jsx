import React from 'react';
import {Route, IndexRoute} from 'react-router';

import GeneralLayoutContainer from './components/GeneralLayout/GeneralLayoutContainer';
import GeneralLayout from './components/GeneralLayout/GeneralLayout';
import IndexContainer from './components/IndexPage/IndexContainer';
import NotebooksContainer from './components/NotebooksPage/NotebooksContainer';
import Error503Page from './components/Errors/Error503Page';

export const routes = (
    <div>
        <Route path='/' component={GeneralLayoutContainer} onEnter={GeneralLayout.auth}>
            <IndexRoute component={IndexContainer}/>
            <Route path='notebooks' component={NotebooksContainer}/>
            <Route path='503' component={Error503Page}/>
        </Route>
    </div>
);
