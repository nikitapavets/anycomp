import React from 'react';
import styled from 'styled-components';
import {bgi} from '../libs/mixins';

const ArrowItemImg = require('../../../static/images/svg/play-button.svg');
const ArrowItem = styled.div`
    position: absolute;
    top: 50%;
    ${_ => _.orientation}: 5px;
    z-index: 1000;
    ${bgi(ArrowItemImg, 26)}
    ${_ => _.orientation == 'left' ? 'transform: rotate(180deg)' : ''}
    cursor: pointer;
`;

export default class Arrow extends React.Component {


    render() {
        return <ArrowItem {...this.props} className={this.props.orientation}/>
    }
}
