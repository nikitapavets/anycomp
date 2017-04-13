import React from 'react';
import {Route, IndexRoute} from 'react-router';

import GeneralLayoutContainer from './components/GeneralLayout/GeneralLayoutContainer';
import GeneralLayout from './components/GeneralLayout/GeneralLayout';
import IndexContainer from './components/IndexPage/IndexContainer';
import NotebooksContainer from './components/NotebooksPage/NotebooksContainer';
import NotebookContainer from './components/NotebookPage/NotebookContainer';
import TvsContainer from './components/TvsPage/TvsContainer';
import TvContainer from './components/TvPage/TvContainer';
import LoginContainer from './components/Login/LoginContainer';
import Error503Page from './components/Errors/Error503Page';

export const routes = (
    <div>
        <Route path='/' component={GeneralLayoutContainer} onEnter={GeneralLayout.auth}>
            <IndexRoute component={IndexContainer}/>
            <Route path='notebooks' component={NotebooksContainer}/>
            <Route path='notebooks/:brand/:model' component={NotebookContainer}/>
            <Route path='tvs' component={TvsContainer}/>
            <Route path='tvs/:brand/:model' component={TvContainer}/>
            <Route path='login' component={LoginContainer}/>
            <Route path='503' component={Error503Page}/>
        </Route>
    </div>
);
