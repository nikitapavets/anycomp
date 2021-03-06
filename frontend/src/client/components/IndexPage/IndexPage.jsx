import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';
import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';
import {bgi, media, sizes} from '../../libs/mixins';
import Slick from '../../components/Slick';
import Arrow from '../../components/Arrow';
import config from '../../../core/config/general';
import Loader from '../Loader';
import NumberFormat from 'react-number-format';
import DocumentMeta from 'react-document-meta';

const Slider = styled.div`
`;
const SliderContainer = styled(Container)`
    padding-bottom: 30px;
`;
const Slide = styled.div`
    position: relative;
    height: 450px!important;
    background: ${colors.white};
`;
const Slide__Header = styled.div`
    position: absolute;
    top: 15px;
    left: 15px;
`;
const Slide__HeaderBrand = styled.div`
    color: ${colors.black};
    font-size: ${fontSizes.max};
    font-weight: 300;
`;
const Slide__HeaderModel = styled.div`
    color: ${colors.main};
    font-size: ${fontSizes.xxl};
    font-weight: 300;
    font-style: italic;
`;

const Slide__Core = styled.div`
    padding: 110px 15px 0 15px;
`;
const Slide__CoreImage = styled.img`
    height: 320px;
    margin: 0 auto;
    opacity: .75;
`;

const Slide__HeaderBuyNow = styled(Link)`
    display: inline-block;
    background: ${colors.main};
    color: ${colors.white};
    text-decoration: none;
    text-transform: uppercase;
    margin-top: 10px;
    text-align: center;
    padding: 10px;
    font-weight: 800;
    transition: .5s ease all;
    &:hover {
        background: ${colors.red};
    }
`;

const Slide__HeaderPrice = styled(NumberFormat)`
    margin-left: 5px;
`;
const Catalog = styled.div`
    position: relative;
    background: ${colors.white};
`;
const Catalog__Container = styled(Container)`
    position: relative;
`;
const Catalog__Title = styled.div`
    padding: 30px 0;
    font-size: ${fontSizes.xxl};
    text-align: center;
    border-bottom: 1px solid ${colors.minor};
    text-transform: uppercase;
`;
const Catalog__Goods = styled.div``;
const Catalog__Good = styled(Link)`
    padding: 15px;
    text-decoration: none;
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
    height: 50px;
`;
const Catalog__GoodDescription = styled.div`
    text-align: center;
    font-size: ${fontSizes.xs};
    line-height: 1.5em;
    opacity: .75;
    height: 90px;
`;
const Catalog__GoodPrice = styled(NumberFormat)`
    display: block;
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
const Catalog__GoodDetailBasketImg = require('../../../../static/images/svg/shopping-cart_ffffff.svg');
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

const Advantages = styled.div`
`;

const AdvantagesContainer = styled(Container)`
    padding: 30px 0;
    position: relative;
     ${media.tablet`
        display: flex;
        justify-content: space-between;
    `}
`;
const Advantage = styled.div`
    position: relative;
    background: ${colors.main};
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    &.delivery {
         background: ${colors.mainBold};
    }
    &.consult {
         background: ${colors.purple};
    }
`;
const AdvantageText = styled.div`
    font-size: ${fontSizes.xxl};
    color: ${colors.white};
    width: 75%;
    ${media.tablet`
        font-size: ${fontSizes.xl};
        width: 100%;
        text-align: center;
    `}
    ${media.desktop`
        font-size: ${fontSizes.xxl};
        width: 75%;
        text-align: left;
    `}
`;
const AdvantageImageChose = require('../../../../static/images/svg/thumbs-up-hand-symbol.svg');
const AdvantageImageDelivery = require('../../../../static/images/svg/delivery-truck.svg');
const AdvantageImageConsult = require('../../../../static/images/svg/male-consultant.svg');
const AdvantageImage = styled.div`
    &.chose {
         ${bgi(AdvantageImageChose, 64)}
    }
    &.delivery {
         ${bgi(AdvantageImageDelivery, 64)}
    }
    &.consult {
         ${bgi(AdvantageImageConsult, 64)}
    }
    ${media.tablet`
        display: none!important;
    `}
    ${media.desktop`
        display: block!important;
    `}
`;

export default class IndexPage extends React.Component {

    handleAddToBasket = (e, basketItem) => {
        this.props.basketAddItem(basketItem);
        e.preventDefault();
    };

    componentDidMount() {
        this.props.handleLoadingNotebooks();
        this.props.handleLoadingTvs();
        this.props.handleLoadingPopularProducts();
    }

    render() {
        const meta = {
            title: 'AnyСomp.by - Компьютерная техника',
            description: 'AnyComp.by - продажи и ремонт компьютерной техники, установка и обслуживание спутникового TV и видеонаблюдения.'
        };

        return (
            <div>
                <DocumentMeta {...meta} />
                {!this.props.popularProducts.isLoading
                    ?
                    <Slider>
                        <SliderContainer>
                            <Slick settings={{
                                dots: true,
                                arrows: false,
                                infinite: true,
                                autoplaySpeed: 2000,
                                autoplay: true,
                                responsive: [
                                    {breakpoint: sizes.tablet + 1, settings: {slidesToShow: 1}},
                                    {breakpoint: sizes.superHd, settings: {slidesToShow: 2}}
                                ]
                            }} checkEmpty>
                                {this.props.popularProducts.data.map((popular, index) =>
                                    <Slide key={index}>
                                        <Slide__Core>
                                            <Slide__CoreImage src={`${config.server}${popular.image}`}
                                                              title={popular.title}
                                                              alt={popular.title}/>
                                        </Slide__Core>
                                        <Slide__Header>
                                            <Slide__HeaderBrand>{popular.brand}</Slide__HeaderBrand>
                                            <Slide__HeaderModel>{popular.model}</Slide__HeaderModel>
                                            <Slide__HeaderBuyNow to={popular.link}>Купить за
                                                <Slide__HeaderPrice value={popular.price} displayType={'text'}
                                                                    thousandSeparator={' '}
                                                                    suffix={' р.'}/>
                                            </Slide__HeaderBuyNow>
                                        </Slide__Header>
                                    </Slide>
                                )}
                            </Slick>
                        </SliderContainer>
                    </Slider>
                    :
                    <Loader/>
                }
                <Catalog>
                    <Catalog__Container>
                        <Catalog__Title>Новые ноутбуки</Catalog__Title>
                        {!this.props.notebooks.isLoading
                            ?
                            <Catalog__Goods>
                                <Slick settings={{
                                    arrows: true,
                                    nextArrow: <Arrow orientation='right'/>,
                                    prevArrow: <Arrow orientation='left'/>,
                                    infinite: true,
                                    autoplaySpeed: 2000,
                                    responsive: [
                                        {breakpoint: sizes.mobile + 1, settings: {slidesToShow: 1}},
                                        {breakpoint: sizes.tablet + 1, settings: {slidesToShow: 2}},
                                        {breakpoint: sizes.desktop + 1, settings: {slidesToShow: 3}},
                                        {breakpoint: sizes.superHd, settings: {slidesToShow: 4}}
                                    ]
                                }} checkEmpty>
                                    {this.props.notebooks.data.map((notebook, index) =>
                                        <Catalog__Good to={notebook.link} key={index}>
                                            <Catalog__GoodImageWrap>
                                                <Catalog__GoodImage src={`${config.server}${notebook.image}`}
                                                                    title={notebook.title} alt={notebook.title}/>
                                            </Catalog__GoodImageWrap>
                                            <Catalog__GoodTitle>{notebook.title}</Catalog__GoodTitle>
                                            <Catalog__GoodDescription>{notebook.description}</Catalog__GoodDescription>
                                            <Catalog__GoodPrice value={notebook.price} displayType={'text'}
                                                                thousandSeparator={' '}
                                                                suffix={' р.'}/>
                                            <Catalog__GoodDetails>
                                                <Catalog__GoodDetail className='basket'
                                                                     to='/basket'
                                                                     onClick={_ => this.handleAddToBasket(_, notebook)}/>
                                            </Catalog__GoodDetails>
                                        </Catalog__Good>
                                    )}
                                </Slick>
                            </Catalog__Goods>
                            :
                            <Loader/>
                        }

                    </Catalog__Container>
                </Catalog>
                <Catalog>
                    <Catalog__Container>
                        <Catalog__Title>Новые телевизоры</Catalog__Title>
                        {!this.props.tvs.isLoading
                            ?
                            <Catalog__Goods>
                                <Slick settings={{
                                    arrows: true,
                                    nextArrow: <Arrow orientation='right'/>,
                                    prevArrow: <Arrow orientation='left'/>,
                                    infinite: true,
                                    autoplaySpeed: 2000,
                                    responsive: [
                                        {breakpoint: sizes.mobile + 1, settings: {slidesToShow: 1}},
                                        {breakpoint: sizes.tablet + 1, settings: {slidesToShow: 2}},
                                        {breakpoint: sizes.desktop + 1, settings: {slidesToShow: 3}},
                                        {breakpoint: sizes.superHd, settings: {slidesToShow: 4}}
                                    ]
                                }} checkEmpty>
                                    {this.props.tvs.data.map((tv, index) =>
                                        <Catalog__Good to={tv.link} key={index}>
                                            <Catalog__GoodImageWrap>
                                                <Catalog__GoodImage src={`${config.server}${tv.image}`}
                                                                    title={tv.title} alt={tv.title}/>
                                            </Catalog__GoodImageWrap>
                                            <Catalog__GoodTitle>{tv.title}</Catalog__GoodTitle>
                                            <Catalog__GoodDescription>{tv.description}</Catalog__GoodDescription>
                                            <Catalog__GoodPrice value={tv.price} displayType={'text'}
                                                                thousandSeparator={' '}
                                                                suffix={' р.'}/>
                                            <Catalog__GoodDetails>
                                                <Catalog__GoodDetail className='basket'
                                                                     to='/basket'
                                                                     onClick={_ => this.handleAddToBasket(_, tv)}/>
                                            </Catalog__GoodDetails>
                                        </Catalog__Good>
                                    )}
                                </Slick>
                            </Catalog__Goods>
                            :
                            <Loader/>
                        }
                    </Catalog__Container>
                </Catalog>
                <Advantages>
                    <AdvantagesContainer>
                        <Advantage className='chose'>
                            <AdvantageText>Большой выбор товаров</AdvantageText>
                            <AdvantageImage className='chose'/>
                        </Advantage>
                        <Advantage className='delivery'>
                            <AdvantageText>Доставка по всей Беларуси</AdvantageText>
                            <AdvantageImage className='delivery'/>
                        </Advantage>
                        <Advantage className='consult'>
                            <AdvantageText>Консультация специалиста</AdvantageText>
                            <AdvantageImage className='consult'/>
                        </Advantage>
                    </AdvantagesContainer>
                </Advantages>
            </div>
        )
    }
}
