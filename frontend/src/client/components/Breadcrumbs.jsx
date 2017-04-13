import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';
import {bgi} from '../libs/mixins';
import {fontSizes, colors} from '../libs/variables';

const BreadcrumbsStyled = styled.div`
    display: flex;
    padding: 30px 0
    align-items: center;
`;

const Menu__ItemHome = require('../../../static/images/svg/home.svg');
const Menu__ItemHomeActive = require('../../../static/images/svg/home_699AD1.svg');
const BreadcrumbsLink = styled(Link)`
    font-size: ${fontSizes.s};
    text-decoration: none;
    margin-right: 10px;
    &:hover {
        color: ${colors.main};
    }
    &:before {
        content: '>';
        padding: 0;
        margin-right: 10px;
        font-size: 12px;
        color: ${colors.black};
    }
    &:first-child {
        ${bgi(Menu__ItemHome, 14)}
        background-position: center;
        padding: 0;
        &:hover, &.active {
            ${bgi(Menu__ItemHomeActive, 14)}
        }
        &:before {
            display: none;
        }
    }
`;

export default class Breadcrumbs extends React.Component {
    render() {
        return (
            <BreadcrumbsStyled>
                {this.props.data.map((item, index) =>
                    <BreadcrumbsLink to={item.link} key={index}>{item.title}</BreadcrumbsLink>
                )}
            </BreadcrumbsStyled>
        )
    }
}
