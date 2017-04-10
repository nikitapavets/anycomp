import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';
import {colors, fontSizes} from '../libs/variables';
import {bgi} from '../libs/mixins';
import config from '../../core/config/general';
import {media} from '../libs/mixins';

const Catalog__Good = styled(Link)`
    text-align: center;
    text-decoration: none;
    display: block;
    padding-bottom: 15px;
    margin-bottom: 15px
    border: 3px solid ${colors.white};
    ${media.tablet`
        flex-grow: 1
        width: 250px;
        margin: 15px;
    `}
    &:hover {
        border: 3px solid ${colors.minor};
    }
`;

const Catalog__GoodImageWrap = styled.div`
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 250px;
`;
const Catalog__GoodImage = styled.img`
    width: 250px;
`;
const Catalog__GoodTitle = styled.div`
    text-align: center;
    font-size: ${fontSizes.xl};
    margin: 30px 15px 15px; 
`;
const Catalog__GoodDescription = styled.div`
    text-align: center;
    font-size: ${fontSizes.xs};
    line-height: 1.5em;
    opacity: .75;
    height: 90px;
`;
const Catalog__GoodPrice = styled.div`
    text-align: center;
    color: ${colors.main};
    font-size: ${fontSizes.xl};
    margin: 15px;
    font-weight: 800;
`;
const Catalog__GoodDetails = styled.div`
    display: flex;
    justify-content: center;
`;
const Catalog__GoodDetailBasketImg = require('../../../static/images/svg/shopping-cart_ffffff.svg');
const Catalog__GoodDetail = styled(Link)`
    &.basket {
        ${bgi(Catalog__GoodDetailBasketImg, 22)}
    }
    &:hover {
        background-color: ${colors.red}
    }
    transition: .5s ease all;
    background-color: ${colors.main}
    padding: 20px;
    border-radius: 10em;
`;

export default class CatalogItem extends React.Component {
    handleAddToBasket = (e, basketItem) => {
        this.props.basketAddItem(basketItem);
        e.preventDefault();
    };

    render() {
        return (
            <Catalog__Good to={this.props.item.link}>
                <Catalog__GoodImageWrap>
                    <Catalog__GoodImage src={`${config.server}${this.props.item.imageBig}`}
                                        title={this.props.item.title} alt={this.props.item.title}/>
                </Catalog__GoodImageWrap>
                <Catalog__GoodTitle>{this.props.item.title}</Catalog__GoodTitle>
                <Catalog__GoodDescription>{this.props.item.description}</Catalog__GoodDescription>
                <Catalog__GoodPrice>{this.props.item.price} р.</Catalog__GoodPrice>
                <Catalog__GoodDetails>
                    <Catalog__GoodDetail className='basket'
                                         to='#'
                                         onClick={_ => this.handleAddToBasket(_, this.props.item)}/>
                </Catalog__GoodDetails>
            </Catalog__Good>
        )
    }
}
