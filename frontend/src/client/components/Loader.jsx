import React from 'react';
import styled from 'styled-components';
import {bgi} from '../libs/mixins';
import {colors} from '../libs/variables';

const LoaderImg = require('../../../static/images/loading/facebook.gif');
const LoaderStyled = styled.div`
    ${bgi(LoaderImg, 64)}
    width: 100%;
    padding: 50px;
    background-color: ${colors.white};
`;

export default class Loader extends React.Component {
    render() {
        return (
            <LoaderStyled/>
        )
    }
}
