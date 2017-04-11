import React from 'react';
import styled from 'styled-components';
import {colors, fontSizes} from '../libs/variables';
import {media, bgi} from '../libs/mixins';
import {Container} from '../libs/blocks';
import Breadcrumbs from './Breadcrumbs';
import {Link} from 'react-router';
import Slick from '../components/Slick';
import Arrow from '../components/Arrow';
import Loader from './Loader';
import config from '../../core/config/general';
import NumberFormat from 'react-number-format';

const Catalog = styled.div`
    background-color: ${colors.white};
    padding: 0 15px;
    
`;
const Catalog__Container = styled(Container)`
    background-color: ${colors.white};
    padding: 15px 0;
`;
const Product = styled.div`
`;
const Product__Title = styled.div`
    padding: 15px 0;
    text-align: center;
    font-size: ${fontSizes.xxl};
    font-weight: bold;
    
    ${media.laptop`
         text-align: left;
    `}
`;
const Product__Header = styled.div`
     ${media.laptop`
        display: flex;    
    `};
`;
const Product__Images = styled.div`
    padding-bottom: 45px;
    width: 100%;
    
    ${media.laptop`
         flex: 2 1;
    `}
`;
const Product__ImageWrap = styled.div`
`;
const Product__Image = styled.img`
   width: 100%;
`;
const Product__Options = styled.div`
    font-size: ${fontSizes.s};
    
    ${media.laptop`
        flex: 1 1;
    `}
`;
const Product__OptionsTitle = styled.div`
    font-size: ${fontSizes.xl};
    margin-bottom: 15px;
`;
const Product__Description = styled.div`  
    margin-bottom: 15px;
    line-height: 1.6em;
`;
const Product__Includes = styled.div`
    padding: 5px 0;
`;
const Product__IncludeImg = require('../../../static/images/svg/checked.svg');
const Product__Include = styled.div`
    position: relative;
    padding-left: 30px;
    margin: 15px 0;
    text-transform: uppercase;
    font-weight: 800;
    color: ${colors.main};
    &:before {
        content: '';
        ${bgi(Product__IncludeImg, 25)}
        position: absolute;
        top: -50%;
        left: 0;
    }
    span {
        &.hot {
            text-decoration: underline;
        }
    }
`;
const Product__Buttons = styled.div`
    display: flex;
`;
const Product__ToBasket = styled(Link)`
    display: block;
    text-align: center;
    padding: 15px 30px;
    background: ${colors.main};
    color: ${colors.white};
    margin: 15px 0;
    text-decoration: none;
    font-weight: 800;
    font-size: ${fontSizes.m};
    flex: 1 1;
    &:hover {
        opacity: .75;
    }
`;
const Product__Price = styled(NumberFormat)`
    text-align: center;
    padding: 15px 30px;
    background: ${colors.red};
    color: ${colors.white};
    margin: 15px 0;
    font-weight: 800;
    font-size: ${fontSizes.m};
    flex: 1 1;
`;
const Product__Characteristics = styled.section`
`;
const Characteristics__Title = styled.header`
    font-size: ${fontSizes.xxl};
    font-weight: bold;
    padding: 15px;
`;
const Characteristic = styled.div`
    
`;
const Characteristics__Section = styled.div`
    
`;
const Section__Title = styled.div`
    background-color: ${colors.minor}
    padding: 10px 15px;
    border-bottom: 3px solid #ccc;
    font-weight: bold;
`;
const Characteristic__Param = styled.div`
    padding: 5px 15px;
`;
const Characteristic__Value = styled.div`
    padding: 5px 15px;
    font-weight: bold;
`;

export default class CatalogItemLayout extends React.Component {

    render() {
        const item = this.props.item.review;

        return (
            <Catalog>
                {!this.props.item.isLoading
                    ?
                    <Catalog__Container>
                        <Breadcrumbs data={this.props.breadcrumbs}/>
                        {Object.keys(this.props.item.review).length &&
                        <Product>
                            <Product__Title>{item.title}</Product__Title>
                            <Product__Header>
                                <Product__Images>
                                    <Slick settings={{
                                        dots: true,
                                        arrows: true,
                                        nextArrow: <Arrow orientation='right'/>,
                                        prevArrow: <Arrow orientation='left'/>,
                                        infinite: true,
                                        slidesToShow: 1
                                    }} checkEmpty>
                                        {item.images.map((image, index) =>
                                            <Product__ImageWrap key={index}>
                                                <Product__Image src={`${config.server}${image}`}
                                                                title={item.title} alt={item.title}/>
                                            </Product__ImageWrap>
                                        )}
                                    </Slick>
                                </Product__Images>
                                <Product__Options>
                                    <Product__OptionsTitle>Краткая информация:</Product__OptionsTitle>
                                    <Product__Description>{item.description}</Product__Description>
                                    <Product__Includes>
                                        <Product__Include>
                                            {item.quantity
                                                ? 'В наличии'
                                                : 'Под заказ'
                                            }
                                        </Product__Include>
                                        <Product__Include>Доставка по всей Беларусии</Product__Include>
                                    </Product__Includes>
                                    <Product__Buttons>
                                        <Product__Price value={item.price} displayType={'text'} thousandSeparator={' '}
                                                        suffix={' р.'}/>
                                        <Product__ToBasket to='#'>В корзину</Product__ToBasket>
                                    </Product__Buttons>
                                </Product__Options>
                            </Product__Header>
                            <Product__Characteristics>
                                <Characteristics__Title>Описание</Characteristics__Title>
                                <Characteristics__Section>
                                    <Section__Title>Общее</Section__Title>
                                    <Characteristic>
                                        <Characteristic__Param>Дата выхода на рынок</Characteristic__Param>
                                        <Characteristic__Value>2017</Characteristic__Value>
                                    </Characteristic>
                                </Characteristics__Section>
                            </Product__Characteristics>
                        </Product>
                        }
                    </Catalog__Container >
                    :
                    <Loader/>
                }
            </Catalog>
        )
    }
}
