import React from 'react';

const DEV_MODE = true;

class HomePage extends React.Component {

    static auth = (nextState, replace) => {
        if(DEV_MODE) {
            replace('/503');
        }
    };

    render = () =>
        <div>
            Client HomePage
        </div>
}

export default HomePage;
