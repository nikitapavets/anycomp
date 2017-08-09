import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';
import {colors, fontSizes} from '../../libs/variables';
import {bgi} from '../../libs/mixins';

const RowWidgetStyled = styled.div`
    
`;

const RowWidgetStyled__ItemImg = require('../../../../static/images/svg/down-arrow.svg');
const RowWidgetStyled__ItemActiveImg = require('../../../../static/images/svg/up-arrow.svg');
const RowWidgetStyled__Item = styled(Link)`
    position: relative;
    display: block;
    font-size: ${fontSizes.xs};
    text-decoration: none;
    border-bottom: 1px solid ${colors.minor};
    padding: 10px 0;
    &:after {
        position: absolute;
        content: '';
        right: 5px;
        top: 12px;
        ${bgi(RowWidgetStyled__ItemImg, 9)}
    }
    &.active {
        &:after {
            ${bgi(RowWidgetStyled__ItemActiveImg, 9)}
        }
    }
`;
const RowWidgetStyled__Description = styled.div`
    margin-top: 10px;
`;

export default class RowWidget extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            isActive: false
        };
    }

    static propTypes = {
        title: React.PropTypes.string.isRequired
    };

    handleClick = (e) => {
        e.preventDefault();
        this.setState(_ => ({
            isActive: !_.isActive
        }));
    };

    render() {
        return (
            <RowWidgetStyled>
                <RowWidgetStyled__Item
                    to='#'
                    onClick={this.handleClick}
                    className={this.state.isActive ? 'active' : ''}>
                    {this.props.title}
                </RowWidgetStyled__Item>
                {this.state.isActive &&
                <RowWidgetStyled__Description>
                    {this.props.children}
                </RowWidgetStyled__Description>
                }
            </RowWidgetStyled>
        );
    }
}
