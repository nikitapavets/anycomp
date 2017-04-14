import React from 'react';
import styled from 'styled-components';
import {bgi} from '../libs/mixins';
import {colors} from '../libs/variables';

const LoaderImg = require('../../../static/images/loading/facebook.gif');
const LoaderSmallImg = require('../../../static/images/loading/facebook_small.gif');
const LoaderStyled = styled.div`
    ${bgi(props => props.small ? LoaderSmallImg : LoaderImg, props => props.small ? 22 : 64)}
    width: 100%;
    padding: ${props => props.small ? 5 : 100}px;
`;

export default class Loader extends React.Component {
    render() {
        return (
            <LoaderStyled {...this.props} />
        )
    }
}
