import React from 'react';
import styled from 'styled-components';

const errorImg = require('../../../../static/images/errors/503.jpg');
const Error = styled.div`
    background: url(${errorImg}) no-repeat;
    background-size: 25%
    background-position: center;
    height: 100vh;
`;

export default class Error503Page extends React.Component {
    render = () =>
        <Error />
}
